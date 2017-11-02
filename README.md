# route for zanphp

## 功能说明

> ~ 在 zanphp 中 使用 FastRoute 路由
>
> ~ 兼容 zanphp 默认 路由

## 使用说明

### 1. 安装

`composer require cjeruen/route-for-zanphp:dev-master`

### 2. 配置

#### 2.1 启动加载

`init/WorkerStart/.config.php` 

或者

`init/ServerStart/.config.php`

```
return [
    // other initialize
    \Com\JeRuen\Zan\Routing\FastRoute\InitializeRouter::class,
];
```
#### 2.2 配置路由类型

`resource/config/share/route.php`

```php
return [
    'default_route' => '/index',
    'default_controller' => 'index',
    'default_action' => 'index',
    'default_format' => 'html',

    'router_class' => 'Com\JeRuen\Zan\Routing\FastRoute\Router',
    'router_path' => 'src/routing.php',

];
```

#### 2.3 定义路由规则

```php

<?php

use Com\JeRuen\Zan\Routing\FastRoute\Route;

/** @var \Com\JeRuen\Zan\Routing\FastRoute\Route $route */
$route = Route::getInstance();

/** @var  \FastRoute\RouteCollector */
$r = $route->getRouteController();

$r->get('/index', 'index/index/index');

```

## 相关连接
- [zan-docker](https://github.com/cjeruen/zan-docker)
- [zan官网](http://zanphp.io/)
- [FastRoute](https://github.com/nikic/FastRoute)

## Zan* QQ交流群

- 115728122
