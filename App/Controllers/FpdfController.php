<?php

namespace App\Controllers;

require __DIR__ . '/../Fpdf/fpdfOpacity.php';
require __DIR__ . '/TaskController.php';

final class FpdfController
{
    public function pdfTask($task_id)
    {
        $taskController = new TaskController();
        $data = $taskController->getId($task_id);
        $fonte = 'Arial';
        $tamanhoFonte = 11;
        $pdf = new AlphaPDF();
        $pdf->SetMargins(15, 15, 15);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        // $pdf->Ln(10);
        $pdf->setTitle('Tarefa');
        $pdf->Ln(-2);
        $pdf->Image('../view/assets/image/logo2.png', 15, 8, 40, 12);
        $pdf->SetFont($fonte, 'I', 10);
        $pdf->Cell(60, 5, '', 0);
        $pdf->Cell(120, 5, utf8_decode('R. Tristão de Castro, 350 - São Benedito, Uberaba - MG, 38022-010'), 0, 1);
        $pdf->Cell(60, 5, '', 0);
        $pdf->Cell(120, 5, utf8_decode('Telefone: (34) 3312-8082'), 0, 0, 'C');
        $pdf->Line(10, 25, 200, 25);
        $pdf->Ln(10);
        $pdf->SetFont($fonte, 'B', 14);
        $pdf->Cell(180, 10, 'EasyJur Gerenciador de Tarefas', 0, 1, 'C');
        $pdf->Ln(7);
        $pdf->SetAlpha(0.2, 'Normal');
        $pdf->Image('../view/assets/image/logo2.png', 55, 100, 100, 32);
        $pdf->SetAlpha(1, 'Normal');
        $pdf->SetFont($fonte, 'B', $tamanhoFonte);
        $pdf->Cell(25, 8,   utf8_decode('Noma Tarefa: ') , 0, 0);
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->Cell(180, 8,   utf8_decode($data['task_name']) , 0, 1);
        $pdf->SetFont($fonte, 'B', $tamanhoFonte);
        $pdf->Cell(14, 8,   utf8_decode('Status: ') , 0, 0);
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->Cell(180, 8,   utf8_decode($data['status']) , 0, 1);
        $pdf->SetFont($fonte, 'B', $tamanhoFonte);
        $pdf->Cell(26, 8,   utf8_decode('Data Criação: ') , 0, 0);
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->Cell(180, 8,   utf8_decode(date('d/m/Y H:i:s', strtotime($data['create_at']))) , 0, 1);
        $pdf->SetFont($fonte, 'B', $tamanhoFonte);
        $pdf->Cell(31, 8,   utf8_decode('Data Conclusão: ') , 0, 0);
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->Cell(180, 8,   utf8_decode($data['date_conclusion'] == NULL || empty($data['date_conclusion']) ? 'Não concluido' : date('d/m/Y H:i:s', strtotime($data['date_conclusion']))) , 0, 1);
        $pdf->SetFont($fonte, 'B', $tamanhoFonte);
        $pdf->Cell(180, 8, utf8_decode('Descrição Tarefa:') , 0, 1);
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->MultiCell(180, 8, utf8_decode($data['task_description']));
        $pdf->SetFont($fonte, '', $tamanhoFonte);
        $pdf->Output('I', 'Receituario.pdf');
    }

    public function pdfAllTask(){
        $taskController = new TaskController();
        $dados = $taskController->getAll();
        $fonte = 'Arial';
        $tamanhoFonte = 11;
        $pdf = new AlphaPDF();
        $pdf->SetMargins(15, 15, 15);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        // $pdf->Ln(10);
        $pdf->setTitle('Tarefa');
        $pdf->Ln(-2);
        $pdf->Image('../view/assets/image/logo2.png', 15, 8, 40, 12);
        $pdf->SetFont($fonte, 'I', 10);
        $pdf->Cell(60, 5, '', 0);
        $pdf->Cell(120, 5, utf8_decode('R. Tristão de Castro, 350 - São Benedito, Uberaba - MG, 38022-010'), 0, 1);
        $pdf->Cell(60, 5, '', 0);
        $pdf->Cell(120, 5, utf8_decode('Telefone: (34) 3312-8082'), 0, 0, 'C');
        $pdf->Line(10, 25, 200, 25);
        $pdf->Ln(10);
        $pdf->SetFont($fonte, 'B', 14);
        $pdf->Cell(180, 10, 'EasyJur Gerenciador de Tarefas', 0, 1, 'C');
        $pdf->Ln(7);
        $pdf->SetAlpha(0.2, 'Normal');
        $pdf->Image('../view/assets/image/logo2.png', 55, 100, 100, 32);
        $pdf->SetAlpha(1, 'Normal');
        foreach ($dados as $data){
            $pdf->SetFont($fonte, 'B', $tamanhoFonte);
            $pdf->Cell(25, 8,   utf8_decode('Noma Tarefa: ') , 0, 0);
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->Cell(155, 8,   utf8_decode($data['task_name']) , 0, 1);
            $pdf->SetFont($fonte, 'B', $tamanhoFonte);
            $pdf->Cell(14, 8,   utf8_decode('Status: ') , 0, 0);
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->Cell(180, 8,   utf8_decode($data['status']) , 0, 1);
            $pdf->SetFont($fonte, 'B', $tamanhoFonte);
            $pdf->Cell(26, 8,   utf8_decode('Data Criação: ') , 0, 0);
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->Cell(180, 8,   utf8_decode(date('d/m/Y H:i:s', strtotime($data['create_at']))) , 0, 1);
            $pdf->SetFont($fonte, 'B', $tamanhoFonte);
            $pdf->Cell(31, 8,   utf8_decode('Data Conclusão: ') , 0, 0);
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->Cell(180, 8,   utf8_decode($data['date_conclusion'] == NULL || empty($data['date_conclusion']) ? 'Não concluido' : date('d/m/Y H:i:s', strtotime($data['date_conclusion']))) , 0, 1);
            $pdf->SetFont($fonte, 'B', $tamanhoFonte);
            $pdf->Cell(180, 8, utf8_decode('Descrição Tarefa:') , 0, 1);
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->MultiCell(180, 8, utf8_decode($data['task_description']));
            $pdf->SetFont($fonte, '', $tamanhoFonte);
            $pdf->Cell(180, 5, '', 'B', 1);
            $pdf->Ln(7);
        }
        $pdf->Output('I', 'Receituario.pdf');
    }
}
