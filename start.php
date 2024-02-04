<?php
/**
 * Arquivo "boostrap" do sistema, carrega dependências.
 *
 * @author Gabriel Testa | gabrielaugustotesta@gmail.com
 */
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\Database;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/**
 * Emite os headers necessários para funcionamento da API
 *
 * @return void
 */
function emitirHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}