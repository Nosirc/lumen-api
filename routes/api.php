<?php

$api->get('/', function () {
    return 'v1.0.0';
});

// 小程序
$api->group(['namespace' => 'Wxapp','prefix' => 'wxapp'], function($api) {
    require __DIR__ . '/wxapp.php';
});