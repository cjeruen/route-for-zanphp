<?php namespace Com\JeRuen\Zan\Routing\FastRoute;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/2
 * Time: 上午9:56
 */

class R
{
    /**
     * @return \FastRoute\RouteCollector
     */
    private static function r() {
        return Route::getInstance()->getRouteController();
    }

    public static function addRoute($httpMethod, $route, $handler) {
        static::r()->addRoute($httpMethod, $route, $handler);
    }

    public static function addGroup($prefix, callable $callback) {
        static::r()->addGroup($prefix, $callback);
    }

    public static function get($route, $handler)
    {
        static::r()->get($route, $handler);
    }

    public static function post($route, $handler)
    {
        static::r()->post($route, $handler);
    }

    public static function put($route, $handler)
    {
        static::r()->put($route, $handler);
    }

    public static function delete($route, $handler)
    {
        static::r()->delete($route, $handler);
    }

    public static function head($route, $handler)
    {
        static::r()->delete($route, $handler);
    }

}
