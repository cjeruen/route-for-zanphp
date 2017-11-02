<?php namespace Com\JeRuen\Zan\Routing\FastRoute;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/1
 * Time: 上午7:52
 */

use ZanPHP\Support\Singleton;

use FastRoute;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\DataGenerator\GroupCountBased as DataGenerator;
use FastRoute\Dispatcher\GroupCountBased as Dispatcher;
use FastRoute\RouteCollector;

use Com\JeRuen\Zan\Routing\Route as RouteContract;

class RouteManager implements RouteContract
{
    use Singleton;

    /** @var  \FastRoute\RouteCollector */
    private $routeCollector;

    /** @var  \FastRoute\Dispatcher\GroupCountBased */
    private $dispatcher;

    public function addRoute($httpMethod, $route, $handler) {
        $this->routeCollector->addRoute($httpMethod, $route, $handler);
    }

    public function addGroup($prefix, callable $callback) {
        $this->routeCollector->addGroup($prefix, $callback);
    }

    public function get($route, $handler)
    {
        $this->routeCollector->get($route, $handler);
    }

    public function post($route, $handler)
    {
        $this->routeCollector->post($route, $handler);
    }

    public function put($route, $handler)
    {
        $this->routeCollector->put($route, $handler);
    }

    public function delete($route, $handler)
    {
        $this->routeCollector->delete($route, $handler);
    }

    public function head($route, $handler)
    {
        $this->routeCollector->delete($route, $handler);
    }

    /**
     * when InitializeRouter
     */
    public function initRouteCollector()
    {
        $this->routeCollector = new RouteCollector(new RouteParser, new DataGenerator);
    }

    /**
     * when InitializeRouter
     */
    public function initDispatcher()
    {
        $this->dispatcher = new Dispatcher($this->routeCollector->getData());
    }

    /**
     * @return FastRoute\RouteCollector
     */
    public function getRouteController()
    {
        return $this->routeCollector;
    }

    /**
     * @return FastRoute\Dispatcher\GroupCountBased
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

}
