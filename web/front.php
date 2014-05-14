<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午5:36
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Symfony\Component\HttpKernel\Exception\FlattenException;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routing.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver();
$dispatcher = new EventDispatcher();

//listener for routing
$dispatcher->addSubscriber(new RouterListener($matcher));

//listener for converting string to response
$dispatcher->addSubscriber(new \Simplex\Subscriber\StringResponseSubscriber());

//listener for customizing exception handling
$dispatcher->addSubscriber(new \Simplex\Subscriber\ExceptionSubscriber());

//use subscribers
//$dispatcher->addSubscriber(new \Simplex\Subscriber\GoogleSubscriber());
//$dispatcher->addSubscriber(new \Simplex\Subscriber\ContentLengthSubscriber());

//use listeners
/*
$dispatcher->addListener('response', array(new \Simplex\Listener\GoogleListener(), 'onResponse'));
$dispatcher->addListener('response', array(new \Simplex\Listener\ContentLengthListener(), 'onResponse'), -255);
*/
//use traits to listen events
/*
$dispatcher->addListener('response', function(\Simplex\Event\ResponseEvent $event) {
    $response = $event->getResponse();
    $request = $event->getRequest();

    if($response->isRedirection() ||
        $response->getStatusCode() != 200 ||
        ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html') ) ||
        $request->getRequestFormat() != 'html' ) {
        return ;
    }

    $response->setContent($response->getContent()."GA code");
});
*/


$framework = new \Simplex\Framework($dispatcher, $resolver);
//$framework = new HttpCache($framework,new Store(__DIR__.'/../cache'));
//$framework = new HttpCache($framework,new Store(__DIR__.'/../cache'), new Esi(), array('debug' => true));
$framework->handle($request)->send();


