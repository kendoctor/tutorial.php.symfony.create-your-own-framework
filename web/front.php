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
use Symfony\Component\DependencyInjection\Reference;

$request = Request::createFromGlobals();

$sc = include __DIR__.'/../src/container.php';
$sc->setParameter('routes', include __DIR__.'/../src/routing.php');
$sc->setParameter('charset', 'UTF-8');

$sc->register('listener.string_to_response', 'Simplex\Subscriber\StringResponseSubscriber');
$sc->register('listener.exception', 'Simplex\Subscriber\ExceptionSubscriber');

$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_to_response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')));

$request = Request::createFromGlobals();

$response = $sc->get('framework')->handle($request);

$response->send();

