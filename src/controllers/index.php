<?php
namespace Src\controllers;
require "../../start.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

print_r($uri);

$entityId = ($uri[3] ?? null);
$controller = null;

switch($uri[2]) {
    case 'users':
    case 'user':
        if($uri[2] === 'users' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        $controller = new UserController($_SERVER['REQUEST_METHOD'], $entityId);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}

