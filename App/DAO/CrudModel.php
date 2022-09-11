<?php

namespace App\DAO;
require __DIR__ . '/connect.php';
use App\DAO\conexao;
use PDOException;
use Exception;


class CrudModel extends Conexao
{
    protected $table;
    protected $primaryKey;

    public function __construct()
    {
        parent::__construct();
        /**
         * @var string
         */
    }

    /**
     * Gerador de SQL para insert e update
     *
     * @param array $lista
     * @param string $tipo
     * @return array
     */
    public function geraSQL(array $lista, string $tipo): array
    {
        $str_lista = "";
        $arrayBindValue = [];
        if ($tipo == "INSERT") {
            $str_lista = "INSERT INTO $this->table ( ";
            $str_key = "";
            $str_value = "";
            foreach ($lista as $key => $value) {
                if (!isset($value) && $key != $this->primaryKey) {
                    $str_key = $str_key . $key . ",";
                    $str_value = $str_value . "null,";
                } else if ($value != "") {
                    $str_key = $str_key . $key . ",";
                    $str_value =  $str_value . ':'.$key . ",";
                    $arrayBindValue[$key] = $value;
                }
            }
            $str_key = substr($str_key, 0, -1);
            $str_value = substr($str_value, 0, -1);
            $str_lista = $str_lista . $str_key . ") VALUES (" . $str_value . ")";
        } else if ($tipo == "UPDATE") {
            $str_lista   = "UPDATE $this->table set ";
            foreach ($lista as $key => $value) {
                if (isset($value) && $value != ""){
                    $str_lista =  $str_lista . $key . "=" . ':' . $key . ",";
                    $arrayBindValue[$key] = $value;
                }
            }
            $str_lista = substr($str_lista, 0, -1);
        }
        return ["sql" => $str_lista, "bind" => $arrayBindValue];
    }

    /**
     * Lista dos 100 ultimos registros
     *
     * @return array
     */
    public function getAll(): array
    {
        try {
            $sql = "SELECT * from $this->table ORDER BY $this->primaryKey DESC limit 100;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    /**
     * Busca por Chave Primaria
     *
     * @param [type] $id
     * @return array
     */
    public function find($id): array
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    /**
     * Atualiza dados
     *
     * @param [type] $model
     * @return void
     */
    public function update($model): void
    {
        try {
            $geraSql = $this->geraSQL($model->getArrayUpdate(), 'UPDATE');
            $sql = $geraSql['sql'];
            $bind = $geraSql['bind'];
            $sql = $sql . " WHERE  $this->primaryKey = :task_id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($bind);
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    /**
     * Delete Item
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    /**
     * Insert dados
     *
     * @param [all] $model
     * @return void
     */
    public function insert($model): void
    {
        try {
            $geraSql = $this->geraSQL($model->getArrayInsert(), 'INSERT');
            $sql = $geraSql['sql'];
            $bind = $geraSql['bind'];
            $statement = $this->pdo->prepare($sql);
            $statement->execute($bind);
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

}
