<?php
/**
 * Created by PhpStorm.
 * User: Nosirc
 * Date: 2018/11/22
 * Time: 11:54
 */

$api->get('/index', 'IndexController@index');
$api->get('/movies', 'IndexController@getMoviesList');
$api->get('/forms', 'IndexController@getFormList');
$api->get('/chapter', 'IndexController@getChapterList');
$api->get('/movies-info', 'IndexController@getMoviesInfo');
$api->get('/chapter-images', 'IndexController@getChapterImages');