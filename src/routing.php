<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午7:08
 * To change this template use File | Settings | File Templates.
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

function is_leap_year($year = null)
{
    if(null === $year)
    {
        $year = date('Y');
    }
    return 0 == $year % 400 || ( 0 == $year % 4 && 0 != $year % 100);
}


class LeapYearController {
    public function indexAction($year)
    {
        if(is_leap_year($year))
        {
            return new Response('Yep, this is a leap year!');
        }
        return new Response('Nope, this is not a leap year!');
    }
}

$routes = new RouteCollection();
// ignore
//$routes->add('bye', new Route('/bye'));

$routes->add('hello', new Route('/hello/{name}', array(
    'name' => 'world',
    '_controller' => function(Request $request) {
        $response = render_template($request);
        $response->headers->set('Content-Type', 'text/html');
        return $response;
    }
)));

$routes->add('leap_year', new Route('/leap_year/{year}', array(
    'year' => null,
    '_controller' => 'LeapYearController::indexAction'
)));

return $routes;