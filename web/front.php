<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午5:36
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__.'/../src/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$path = $request->getPathInfo();

$map = array(
    '/bye' => __DIR__.'/../src/pages/bye.php',
    '/hello' => __DIR__.'/../src/pages/hello.php'
);

if(isset($map[$path]))
{
    ob_start();
    include $map[$path];
    $response->setContent(ob_get_clean());
}else
{
    $response->setStatusCode(404);
    $response->setContent('Not found');
}

$response->send();
