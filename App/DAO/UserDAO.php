<?php

namespace App\DAO;
require __DIR__ . '/CrudModel.php';
use App\DAO\CrudModel;
use PDOException;
use Exception;

class UserDAO extends CrudModel
{
    protected $table = "users";
    protected $primaryKey = "user_id";

    public function login(string $login){
        try {
            $sql = "SELECT * FROM users WHERE login = :login";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':login', $login);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    public function getByEmail(string $email){
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    public function getByCpf(string $cpf){
        try {
            $sql = "SELECT * FROM users WHERE cpf = :cpf";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':cpf', $cpf);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }

    public function getByTelefone(string $telefone){
        try {
            $sql = "SELECT * FROM users WHERE telefone = :telefone";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':telefone', $telefone);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }
    
}
