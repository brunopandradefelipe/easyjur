<?php

namespace App\DAO;
require_once __DIR__ . '../../../env.php';

abstract class Conexao
{
    /**
     * @var \PDO
     */

    protected $pdo;

    /**
     * contructor function
     */
    
    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_NAME');

        $dsn = "mysql:host=$host;dbname=$dbname;port=$port;";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}