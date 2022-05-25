<?php

$routes = ['index' => 'main@index', 'store' => 'main@store', 'cart' => 'main@cart', 'create_account' => 'main@createAccount', 'create_account_submit' => 'main@createAccountSubmit', 'confirm_email' => 'main@confirmEmail', 'login' => 'main@login', 'login_submit' => 'main@loginSubmit', 'logout' => 'main@logout'];

$action = 'index';

if (isset($_GET['action']) && array_key_exists($_GET['action'], $routes)) {
    $action = $_GET['action'];
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controller\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
$ctr->$method();