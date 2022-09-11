<?php

namespace App\Controllers;

require __DIR__ . '/../Fpdf/fpdfOpacity.php';
require __DIR__ . '/TaskController.php';

final class ExcelController
{
    public function excelTask($task_id)
    {
        session_start();
	    ob_start();
        $taskController = new TaskController();
        $data = $taskController->getId($task_id);
        $html = '
            <meta charset="UTF-8">
            <table border="1">
                <tr>
                    <td colspan="5" align="center"><b>Planilha de Tarefas</b></td>
                </tr>
                <tr>
                    <td align="center"><b>Nome Tarefa</b></td>
                    <td align="center"><b>Status</b></td>
                    <td align="center"><b>Data Criação</b></td>
                    <td align="center"><b>Data Conclusão</b></td>
                    <td align="center"><b>Descrição</b></td>
                </tr>
        ';
        $html .= '<tr>';
        $html .= '<td>'.$data['task_name'].'</td>';
        $html .= '<td>'.$data['status'].'</td>';
        $html .= '<td>'.$data['create_at'].'</td>';
        $html .= '<td>'.$data['date_conclusion'].'</td>';
        $html .= '<td>'.$data['task_description'].'</td>';
        $html .= '</tr>';
        $html .= '</table>';

        echo $html;
        exit;
    }

    public function excelAllTask(){
        session_start();
	    ob_start();
        $taskController = new TaskController();
        $dados = $taskController->getAll();
        $html = '
            <meta charset="UTF-8">
            <table border="1">
                <tr>
                    <td colspan="5" align="center"><b>Planilha de Tarefas</b></td>
                </tr>
                <tr>
                    <td align="center"><b>Nome Tarefa</b></td>
                    <td align="center"><b>Status</b></td>
                    <td align="center"><b>Data Criação</b></td>
                    <td align="center"><b>Data Conclusão</b></td>
                    <td align="center"><b>Descrição</b></td>
                </tr>
        ';
        foreach($dados as $data){
            $html .= '<tr>';
            $html .= '<td>'.$data['task_name'].'</td>';
            $html .= '<td>'.$data['status'].'</td>';
            $html .= '<td>'.$data['create_at'].'</td>';
            $html .= '<td>'.$data['date_conclusion'].'</td>';
            $html .= '<td>'.$data['task_description'].'</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        echo $html;
        exit;
    }
}
