<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-14
 * Time: 下午1:33
 * To change this template use File | Settings | File Templates.
 */
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$sc =  new ContainerBuilder();
$sc->register('context', 'Symfony\Component\Routing\RequestContext');
$sc->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('context')));

$sc->register('resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$sc->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher')))
;
$sc->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('%charset%'))
;


$sc->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
;
$sc->register('framework', 'Simplex\Framework')
    ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;
return $sc;

