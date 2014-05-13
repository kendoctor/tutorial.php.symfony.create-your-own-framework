<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-5-13
 * Time: 下午10:24
 * To change this template use File | Settings | File Templates.
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Simplex\Framework;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


class FrameworkTest extends PHPUnit_Framework_TestCase {

    public function testNotFoundHandling()
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());
        $response = $framework->handle(new Request());
        $this->assertEquals(404,$response->getStatusCode());
    }

    public function testErrorHandling() {
        $framework = $this->getFrameworkForException(new \Exception());
        $response = $framework->handle(new Request());
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testControllerResponse()
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->returnValue(array(
                '_route' => 'foo',
                'name' => 'kendoctor',
                '_controller' => function($name) {
                    return new Response('Hello '.$name);
                }
            )));

        $resolver = new ControllerResolver();
        $framework = new Framework($resolver, $matcher);
        $response = $framework->handle(new Request());
        $this->assertEquals('Hello kendoctor', $response->getContent());
    }

    protected function getFrameworkForException($exception)
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->throwException($exception));

        $resolver = $this->getMock('Symfony\Component\HttpKernel\Controller\ControllerResolverInterface');

        return new Framework($resolver, $matcher);
    }
}