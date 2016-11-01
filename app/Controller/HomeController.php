<?php 
require_once __DIR__.'/../Provider/router.php';
require_once __DIR__.'/inc/homeControllerFunc.php';
$router = new Router();

$router->route('/',$home_func['login']);
$router->route('/login',$home_func['auth']);
$router->route('/home',$home_func['home']);
$router->route('/single/:id',$home_func['single']);
$router->route('/update_post/:id',$home_func['update_view']);
$router->route('/update_post',$home_func['update']);
$router->route('/users',$home_func['users']);
$router->route('/sign',$home_func['sign']);
$router->route('/sign_up',$home_func['sign_up']);
$router->route('/write',$home_func['write']);
$router->route('/write_up',$home_func['write_up']);
$router->route('/single/:id/comment',$home_func['comment']);
$router->route('/disconect',$home_func['disconect']);
$router->end();
