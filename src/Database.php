<?php
namespace Src;

use PDO;
use PDOException;

class Database{
    private ?PDO $conexaoDB = null;

    /**
     * Cria conexão com banco de dados via PDO
     */
    public function __construct() {
        $host       = $_ENV['DB_HOST'];
        $port       = $_ENV['DB_PORT'];
        $schema     = $_ENV['DB_DATABASE'];
        $username   = $_ENV['DB_USERNAME'];
        $password   = $_ENV['DB_PASSWORD'];

        try {
            $this->conexaoDB = new PDO("mysql:host={$host};port={$port};dbname={$schema}", $username, $password);
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * Retorna objeto de conexão PDO
     *
     * @return PDO|null
     */
    public function getConexao(): ?PDO
    {
        return $this->conexaoDB;
    }
}