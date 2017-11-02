<?php namespace Com\JeRuen\Zan\Routing\FastRoute;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/1
 * Time: 上午7:53
 */

use ZanPHP\Contracts\Config\Repository;
use ZanPHP\Contracts\Foundation\Application;

class InitializeRouter
{
    public function bootstrap($server, $workerId = -1)
    {

        /** @var  \ZanPHP\Contracts\Foundation\Application $application */
        $application = make(Application::class);

        /** @var  \ZanPHP\Contracts\Config\Repository $repository */
        $repository = make(Repository::class);

        $routerClass = $repository->get('route.router_class');

        if (!$routerClass || !class_exists($routerClass)) {
            sys_error('route.router_class class not exists!');
            return;
        }

        $routePath = $repository->get('route.router_path', 'src/routing.php');
        $routePath = $application->getBasePath() . '/' . $routePath;


        /** @var \Com\JeRuen\Zan\Routing\FastRoute\Route $route */
        $route = Route::getInstance();

        $route->initRouteCollector();

        // load the routing rule
        if (file_exists($routePath)) {
            include $routePath;
        }

        $route->initDispatcher();

    }

}
