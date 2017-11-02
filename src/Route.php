<?php namespace Com\JeRuen\Zan\Routing;
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/11/2
 * Time: 下午1:28
 */
interface Route
{
    public function addRoute($httpMethod, $route, $handler);

    public function addGroup($prefix, callable $callback);

    public function get($route, $handler);

    public function post($route, $handler);

    public function put($route, $handler);

    public function delete($route, $handler);

    public function head($route, $handler);
}
