<?php

namespace App\DAO;

require __DIR__ . '/CrudModel.php';

use App\DAO\CrudModel;
use Exception;
use PDOException;


class TaskDAO extends CrudModel
{
    protected $table = "tasks";
    protected $primaryKey = "task_id";

    /**
     * Busca pelas tarefas do usúario logado
     *
     * @param int|string $user_id
     * @return array|void
     */
    public function getTasksByUser($user_id)
    {
        try {
            $sql = "SELECT * from $this->table WHERE user_id = :user_id ORDER BY $this->primaryKey DESC limit 100;";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':user_id', $user_id);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }


    /**
     * Atualiza status da tarefa para concluido
     *
     * @param int|string $task_id
     * @return void
     */
    public function updateStatusTask($task_id)
    {
        try {
            $sql = "UPDATE tasks SET date_conclusion = NOW(), status = 'concluido' WHERE task_id = :task_id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':task_id', $task_id);
            $statement->execute();
        } catch (PDOException $e) {
            $erro = $e->getMessage();
            throw new Exception($erro);
        }
    }
}
