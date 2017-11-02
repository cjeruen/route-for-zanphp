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

class Route
{
    use Singleton;

    /** @var  \FastRoute\RouteCollector */
    private $routeCollector;

    /** @var  \FastRoute\Dispatcher\GroupCountBased */
    private $dispatcher;

    public function initRouteCollector()
    {
        $this->routeCollector = new RouteCollector(new RouteParser, new DataGenerator);
    }

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
