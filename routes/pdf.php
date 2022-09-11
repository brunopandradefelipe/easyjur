<?php

require __DIR__ . '/../App/Controllers/fpdfController.php';

use App\Controllers\FpdfController;

try {
    if (isset($_GET['type']) && @!empty($_GET['type'])) {
        $fpdfController = new FpdfController();
        switch ($_GET['type']) {
                /**
             * PDF TASK
             */
            case 'task':
                if (isset($_GET['task_id']) && @!empty($_GET['task_id'])) {
                    http_response_code(200);
                    header('Content-Type: application/pdf; charset=utf-8');
                    $fpdfController->pdfTask($_GET['task_id']);
                } else {
                    throw new Exception("Not found", 404);
                }
                break;
            case 'alltask':
                http_response_code(200);
                header('Content-Type: application/pdf; charset=utf-8');
                $fpdfController->pdfAllTask();
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
