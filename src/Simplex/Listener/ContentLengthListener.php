<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-5-13
 * Time: 下午11:05
 * To change this template use File | Settings | File Templates.
 */

namespace Simplex\Listener;


use Simplex\Event\ResponseEvent;

class ContentLengthListener {
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $request = $event->getRequest();
        if(!$response->headers->has('Content-Length') && !$response->headers->has('Transfer-Encoding'))
        {
            $response->headers->set('Content-Length', strlen($response->getContent()));
        }
    }
}