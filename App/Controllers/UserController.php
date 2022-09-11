<?php

namespace App\Controllers;

require __DIR__ . '/../DAO/UserDAO.php';
require __DIR__ . '/../Models/User.php';

use App\DAO\UserDAO;
use Exception;
use App\Models\UserModel;

final class UserController
{
    /**
     * Lista dos ultimos 100 usúarios cadastrados
     *
     * @return array|null
     */
    public function getAll()
    {
        try {
            $userDAO = new UserDAO();
            $user = $userDAO->getAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $user;
    }


    /**
     * Busca pelo ID
     *
     * @param integer $user_id
     * @return array|null
     */
    public function getId(int $user_id)
    {
        try {
            $userDAO = new UserDAO();
            $user = $userDAO->find($user_id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $user;
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
            $userModel = new UserModel();
            $userDAO = new UserDAO();
            $data = $this->validate($dados);
            $unique = 0;
            $msgUnique = "";
            $emailUnique = count($userDAO->getByEmail($data['email']));
            $cpfUnique = count($userDAO->getByCpf($data['cpf']));
            $telefoneUnique = count($userDAO->getByTelefone($data['telefone']));
            $loginUnique = count($userDAO->login($data['login']));
            if($emailUnique > 0){
                $msgUnique .= "Email já está em uso.<br/>";
                $unique++;
            }
            if($cpfUnique > 0){
                $msgUnique .= "Cpf já está em uso.<br/>";
                $unique++;
            }
            if($telefoneUnique > 0){
                $msgUnique .= "Telefone já está em uso.<br/>";
                $unique++;
            }
            if($loginUnique > 0){
                $msgUnique .= "Login já está em uso.<br/>";
                $unique++;
            }
            if($unique == 0){
                $data['admin'] = 'nao';
                $user = $userModel->setUser($data);
                $userDAO->insert($user);
                $response = [
                    'message' => 'Usuário cadastrado com sucesso!',
                    'status' => 201
                ];
            } else {
                $response = [
                    'message' => $msgUnique,
                    'status' => 422
                ];
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
     * Atualiza dados do usúario
     *
     * @param array $dados
     * @return array
     */
    public function update(array $dados)
    {
        try {
            $userModel = new UserModel();
            $userDAO = new UserDAO();
            if (isset($dados['user_id'])) {
                $data = $this->validate($dados);
                $user = $userModel->setUser($data);
                $userDAO->update($user);
                $response = [
                    'message' => 'Usuário cadastrado com sucesso!',
                    'status' => 200
                ];
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
     * Deleta Usúario
     *
     * @param [type] $id
     * @return array
     */
    public function delete($id)
    {
        try {
            $userDAO = new UserDAO();
            $userDAO->delete($id);
            $response = [
                'message' => 'Usuário ' . $id . ' excluído com sucesso!',
                'status' => 200
            ];
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'status' => 400
            ];
        }
        $response = json_encode($response);
        return $response;
    }

    /**
     * Login
     *
     * @param array $dados
     * @return array
     */
    public function login(array $dados)
    {
        $userDAO = new UserDAO();
        if (!empty($dados['login']) && !empty($dados['senha'])) {
            $user = $userDAO->login($dados['login']);
            if (count($user) > 0) {
                if (password_verify($dados['senha'], $user[0]['senha'])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $user[0]['user_id'];
                    $_SESSION['nome'] = $user[0]['name'];
                    $_SESSION['email'] = $user[0]['email'];
                    $_SESSION['admin'] = $user[0]['admin'];
                    $response = ["message" => "Autenticação realizada com sucesso!", "status" => 200];
                } else {
                    $response = ["message" => "Credenciais invalidas!", "status" => 401];
                }
            } else {
                $response = ["message" => "Credenciais invalidas!", "status" => 401];
            }
        } else {
            $response = ["message" => "Informe suas credenciais!", "status" => 401];
        }
        return $response;
    }

    /**
     * Logout
     *
     * @return array
     */
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        unset($_SESSION);
        session_destroy();
        $response = ["message" => "Logout realizado com sucesso!", "status" => 200];
        return $response;
    }

    /**
     * Validacao
     *
     * @param array $dados
     * @return array
     */
    public function validate(array $dados)
    {
        if (isset($dados['cpf']) && @!empty($dados['cpf'])) {
            $dados['cpf'] = preg_replace("/[^0-9]/", "", $dados['cpf']);
        }
        if (isset($dados['telefone']) && @!empty($dados['telefone'])) {
            $dados['telefone'] = preg_replace("/[^0-9]/", "", $dados['telefone']);
        }
        if (isset($dados['senha']) && @!empty($dados['senha'])) {
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }
        return $dados;
    }
}
