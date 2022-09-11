<?php

require __DIR__ . '/../App/Controllers/UserController.php';

use App\Controllers\UserController;

try {
    if (isset($_GET['type']) && @!empty($_GET['type'])) {
        $userController = new UserController();
        switch ($_GET['type']) {
                /**
                 * API INSERT USER
                 */
            case 'insert':
                $response = $userController->save($_POST);
                if ($response['status'] == 201) {
                    response($response['message'], $response['status']);
                } else if ($response['status'] == 422) {
                    response($response['message'], $response['status']);
                } else {
                    response("Falha ao inserir", 400);
                }
                break;
                /**
                 * API LOGIN USER
                 */
            case 'login':
                $response = $userController->login($_POST);
                if ($response['status'] == 200) {
                    response($response['message'], $response['status']);
                } else {
                    response("Credenciais invalidas", 401);
                }
                break;
                /**
                 * API LOGOUT USER
                 */
            case 'logout':
                $response = $userController->logout();
                if ($response['status'] == 200) {
                    response($response['message'], $response['status']);
                } else {
                    response("Acesso Negado", 401);
                }
                break;
            default:
                throw new Exception("Not found", 404);
                break;
        }
    } else {
        throw new Exception("Not found", 404);
    }
} catch (Exception $e) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($e->getCode());
    echo json_encode(["message" => $e->getMessage(), "status" => $e->getCode()]);
}

/**
 * Undocumented function
 *
 * @param string $message
 * @param int $code
 * @return void
 */
function response($message, $code)
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["message" => $message, "status" => $code]);
}
