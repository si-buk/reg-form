<?php
session_start();
require_once 'classes/Router.php';
require_once 'classes/Auth.php';

$auth = new Auth();
$auth->addSession();

$url = key($_GET);

$router = new Router();

$router->addRoute('/', 'main.php');

if($_SESSION['name']){
    $router->addRoute('/users', 'users.php');
}else{
    $router->addRoute('/register', 'register.php');
    $router->addRoute('/login', 'login.php');
}

$router->route('/'.$url);
$router->route('/users'.$url);
$router->route('/register'.$url);
$router->route('/login'.$url);

