<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午11:08
 * To change this template use File | Settings | File Templates.
 */

namespace Simplex\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class ResponseEvent
 * @package Simplex\Event
 */
class ResponseEvent extends Event {
    private $response;
    private $request;

    public function __construct($response, $request) {
        $this->request = $request;
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }
}