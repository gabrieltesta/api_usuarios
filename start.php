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

$conexaoDB = (new Database())->getConexao();