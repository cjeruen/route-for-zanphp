<?php namespace Com\JeRuen\Zan\Routing\FastRoute;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/1
 * Time: 上午7:53
 */

use Com\JeRuen\Zan\Routing\Route;
use ZanPHP\Contracts\Config\Repository;
use ZanPHP\HttpFoundation\Request\Request;
use ZanPHP\Routing\IRouter;

use FastRoute;

class Router implements IRouter
{

    private $notFoundHandler = 'exception/error/notFound';
    private $methodNotAllowedHandler = 'exception/error/methodNotAllowed';

    public function dispatch(Request $request)
    {

        $routeInfo = $this->handleUrlViaFastRoute($request);

        $handler = $routeInfo['handler'];
        $query = $routeInfo['query'];

        /** @var \ZanPHP\Contracts\Config\Repository $repository */
        $repository = make(Repository::class);

        if ($repository->get('route.router_compatible', false)) {
            // if not found use default zan router
            if ($this->notFoundHandler === $handler) {
                $handler = $request->getRoute();
            }
        }

        $separator = "/";
        $parts = array_filter(explode($separator, trim($handler, $separator)));
        $actionName = array_pop($parts);
        $controllerName = array_pop($parts);
        $moduleName = join($separator, $parts);

        return array($moduleName, $controllerName, $actionName, $query);
    }

    /**
     * FastRoute 处理路由 获取 路由相关信息
     * FastRoute doc : https://github.com/nikic/FastRoute
     * @param Request $request
     * @return array
     */
    private function handleUrlViaFastRoute(Request $request)
    {

        $return = array(
            'handler' => '',
            'query' => []
        );

        /** @var \Com\JeRuen\Zan\Routing\FastRoute\RouteManager $route */
        $route = make(Route::class);

        $dispatcher = $route->getDispatcher();

        $httpMethod = $request->getMethod();
        $uri = $request->getRequestUri();

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode(rtrim($uri, "/"));

        // 处理 只有 / 情况
        if ('' == $uri) $uri = '/';

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                $return['handler'] = $this->notFoundHandler;
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $return['handler'] = $this->methodNotAllowedHandler;
                break;
            case FastRoute\Dispatcher::FOUND:
                $return['handler'] = $routeInfo[1];
                $return['query'] = $routeInfo[2];
                break;
        }

        return $return;

    }
}
