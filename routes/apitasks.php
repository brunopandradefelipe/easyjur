<?php

require __DIR__ . '/../App/Controllers/TaskController.php';

use App\Controllers\TaskController;

try {
    if (isset($_GET['type']) && @!empty($_GET['type'])) {
        $taskController = new TaskController();
        switch ($_GET['type']) {
                /**
             * API INSERT TASK
             */
            case 'insert':
                $response = $taskController->save($_POST);
                if ($response['status'] == 201) {
                    response($response['message'], $response['status']);
                } else if ($response['status'] == 422) {
                    response($response['message'], $response['status']);
                } else {
                    response("Falha ao inserir", 400);
                }
                break;
                /**
                 * API UPDATE TASK
                 */
            case 'update':
                $response = $taskController->update($_POST);
                if ($response['status'] == 200) {
                    response($response['message'], $response['status']);
                } else {
                    response("Falha ao atualizar", 400);
                }
                break;
                /**
                 * API DELETE TASK
                 */
            case 'delete':
                if (isset($_GET['id'])) {
                    $response = $taskController->delete($_GET['id']);
                    response($response['message'], $response['status']);
                }
                break;
            case 'status':
                if (isset($_GET['id'])) {
                    $response = $taskController->updateTask($_GET['id']);
                    response($response['message'], $response['status']);
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
 * Api Response
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
