<?php

require __DIR__ . '/../App/Controllers/ExcelController.php';

use App\Controllers\ExcelController;

try {
    if (isset($_GET['type']) && @!empty($_GET['type'])) {
        $ExcelController = new ExcelController();
        switch ($_GET['type']) {
                /**
             * EXCEL TASK
             */
            case 'task':
                if (isset($_GET['task_id']) && @!empty($_GET['task_id'])) {
                    http_response_code(200);
                    header("Content-Description: PHP Generated Data");
                    header("Content-type: application/x-msexcel");
                    header("Content-Disposition: attachment; filename=teste.xls");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre=check=0");
                    header("Pragma: no-cache");
                    $ExcelController->excelTask($_GET['task_id']);
                } else {
                    throw new Exception("Not found", 404);
                }
                break;
            case 'alltask':
                http_response_code(200);
                http_response_code(200);
                header("Content-type: application/vnd.ms-excel");
                header("Content-type: application/force-download");
                header("Content-Disposition: attachment; filename=teste.xls");
                header("Pragma: no-cache");
                $ExcelController->excelAllTask();
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
