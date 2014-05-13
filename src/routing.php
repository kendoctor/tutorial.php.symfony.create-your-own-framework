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


$routes = new RouteCollection();
$routes->add('bye', new Route('/bye'));
$routes->add('hello', new Route('/hello/{name}', array('name' => 'world')));

return $routes;