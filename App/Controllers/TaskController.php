<?php

namespace App\Controllers;

require __DIR__ . '/../DAO/TaskDAO.php';
require __DIR__ . '/../Models/Task.php';

use App\DAO\TaskDAO;
use Exception;
use App\Models\TaskModel;

final class TaskController
{
    /**
     * Lista das ultimas 100 tarefas cadastradas
     *
     * @return array|null
     */
    public function getAll()
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_SESSION['user_id'])){
                $taskDAO = new TaskDAO();
                $id = $_SESSION['user_id'];
                $task = $taskDAO->getTasksByUser($id);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $task;
    }


    /**
     * Busca pelo ID
     *
     * @param integer $task_id
     * @return array|null
     */
    public function getId(int $task_id)
    {
        try {
            $task = array();
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!empty($task_id)) {
                $taskDAO = new TaskDAO();
                $result = $taskDAO->find($task_id);
                if(count($result) > 0){
                    if($_SESSION['user_id'] == $result[0]['user_id']){
                        $task = $result[0];
                    } else {
                        echo "Acesso Negado";
                    }
                } else {
                    echo "Acesso Negado";
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $task;
    }

    /**
     * Salva dados
     *
     * @param array $dados
     * @return array
     */
    public function save(array $dados)
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $taskModel = new TaskModel();
            $taskDAO = new TaskDAO();
            $data = $dados;
            $data['status'] = 'pendente';
            $data['user_id'] = $_SESSION['user_id'];
            $task = $taskModel->setTask($data);
            $taskDAO->insert($task);
            $response = [
                'message' => 'Tarefa cadastrada com sucesso!',
                'status' => 201
            ];
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'status' => 422
            ];
        }
        return $response;
    }

    /**
     * Atualiza dados do task
     *
     * @param array $dados
     * @return array
     */
    public function update(array $dados)
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $taskModel = new TaskModel();
            $taskDAO = new TaskDAO();
            if (isset($dados['task_id'])) {
                $result = $taskDAO->find($dados['task_id']);
                if(count($result) > 0){
                    if($_SESSION['user_id'] == $result[0]['user_id']){
                        $data = $dados;
                        $task = $taskModel->setTask($data);
                        $taskDAO->update($task);
                        $response = [
                            'message' => 'Tarefa atualizada com sucesso!',
                            'status' => 200
                        ];
                    }
                }
            }
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'status' => 422
            ];
        }
        return $response;
    }

    /**
     * Deleta task
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $taskDAO = new TaskDAO();
            $result = $taskDAO->find($id);
            if(count($result) > 0){
                if($result[0]['user_id'] == $_SESSION['user_id']){
                    $taskDAO->delete($id);
                    $response = [
                        'message' => 'Tarefa ' . $id . ' excluído com sucesso!',
                        'status' => 200
                    ];
                } else {
                    $response = [
                        'message' => 'Permissao Negada!',
                        'status' => 401
                    ];
                }
            }
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'status' => 400
            ];
        }
        return $response;
    }

    /**
     * Atualiza Status da tarefa para concluido;
     *
     * @param integer|string $task_id
     * @return array|null
     */
    public function updateTask(int $task_id)
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $taskDAO = new TaskDAO();
            $result = $taskDAO->find($task_id);
            if(count($result) > 0){
                if($result[0]['user_id'] == $_SESSION['user_id']){
                    $taskDAO->updateStatusTask($task_id);
                    $response = [
                        'message' => 'Tarefa ' . $task_id . ' atualizada com sucesso!',
                        'status' => 200
                    ];
                } else {
                    $response = [
                        'message' => 'Permissao Negada!',
                        'status' => 401
                    ];
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $response;
    }

}
