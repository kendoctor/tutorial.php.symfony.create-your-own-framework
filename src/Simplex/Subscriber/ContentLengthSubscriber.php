<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-5-13
 * Time: 下午11:05
 * To change this template use File | Settings | File Templates.
 */

namespace Simplex\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Simplex\Event\ResponseEvent;

class ContentLengthSubscriber implements  EventSubscriberInterface {

    public static function getSubscribedEvents()
    {
        // -255 is the priority for processing event listeners
        return array('response' => array('onResponse', -255));
    }

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