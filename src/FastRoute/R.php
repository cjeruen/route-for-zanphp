<?php namespace Com\JeRuen\Zan\Routing\FastRoute;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/2
 * Time: 上午9:56
 */

use Com\JeRuen\Zan\Routing\Route;

class R
{
    /**
     * @return \FastRoute\RouteCollector
     */
    private static function rc() {
        return make(Route::class)->getRouteController();
    }

    public static function addRoute($httpMethod, $route, $handler) {
        static::rc()->addRoute($httpMethod, $route, $handler);
    }

    public static function addGroup($prefix, callable $callback) {
        static::rc()->addGroup($prefix, $callback);
    }

    public static function get($route, $handler)
    {
        static::rc()->get($route, $handler);
    }

    public static function post($route, $handler)
    {
        static::rc()->post($route, $handler);
    }

    public static function put($route, $handler)
    {
        static::rc()->put($route, $handler);
    }

    public static function delete($route, $handler)
    {
        static::rc()->delete($route, $handler);
    }

    public static function head($route, $handler)
    {
        static::rc()->delete($route, $handler);
    }

}
