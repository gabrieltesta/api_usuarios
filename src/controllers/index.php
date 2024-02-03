<?php
namespace Src\controllers;

require "../../start.php";

emitirHeaders();

// Roteamento das controllers
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$_POST = json_decode(file_get_contents("php://input"), true);
$entityId = ($uri[3] ?? null);

switch($uri[2]) {
    case 'users':
        new UserController($_SERVER['REQUEST_METHOD'], $entityId);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}

