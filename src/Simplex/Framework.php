<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-5-13
 * Time: 下午9:29
 * To change this template use File | Settings | File Templates.
 */
namespace Simplex;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class Framework {
    private $matcher;
    private $resolver;

    public function __construct(ControllerResolver $resolver, UrlMatcher $matcher)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
    }

    public function handle($request)
    {
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->resolver->getController($request);

            $arguments = $this->resolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        }
        catch(ResourceNotFoundException $e)
        {
            $response = new Response('Not found', 404);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            $response = new Response('Internal errors.', 500);
        }

        return $response;
    }
}