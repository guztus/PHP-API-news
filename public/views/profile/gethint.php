<?php

use App\Services\RegisterService;

require_once '../../../vendor/autoload.php';
(Dotenv\Dotenv::createImmutable('../../../'))->load();

session_start();

var_dump($_ENV);


echo "<pre>";
//var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_POST);
var_dump($_SESSION);

if ($_POST['name']) {
    (new RegisterService())->changeUserData(50, 'name', $_POST['name']);
} else if ($_POST['email']) {
    (new RegisterService())->changeUserData(50, 'email', $_POST['email']);
} else if ($_POST['password']) {
    (new RegisterService())->changeUserData(50, 'password', $_POST['password']);
}
