<?php
namespace Src\controllers;

require "../../start.php";

emitirHeaders();

// Roteamento das controllers
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$GLOBALS['URI'] = $uri;

$_POST = json_decode(file_get_contents("php://input"), true);
$indexURI = 1;
if($uri[$indexURI] == 'api_usuarios')
    $indexURI++;

$GLOBALS['URL'] = $uri[$indexURI];

$entityId = ($uri[$indexURI+1] ?? null);


switch($uri[$indexURI]) {
    case 'users':
    case 'users_add':
    case 'users_edit':
    case 'users_delete':
        new UserController($_SERVER['REQUEST_METHOD'], $entityId);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}

