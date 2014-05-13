<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午11:05
 * To change this template use File | Settings | File Templates.
 */

namespace Simplex\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Simplex\Event\ResponseEvent;


class GoogleSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents()
    {
        return array('response' => 'onResponse');
    }

    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $request = $event->getRequest();

        if($response->isRedirection() ||
            $response->getStatusCode() != 200 ||
            ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html') ) ||
            $request->getRequestFormat() != 'html' ) {
            return ;
        }

        $response->setContent($response->getContent()."GA code");
    }
}