<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午9:29
 * To change this template use File | Settings | File Templates.
 */
namespace Simplex;

use Symfony\Component\HttpKernel\HttpKernel;

class Framework extends  HttpKernel {
    /* not needed anymore as extends HttpKernel
    private $matcher;
    private $resolver;
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher, ControllerResolverInterface $resolver, UrlMatcherInterface $matcher)
    {
        $this->dispatcher = $dispatcher;
        $this->matcher = $matcher;
        $this->resolver = $resolver;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true )
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

        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));

        return $response;
    }*/
}