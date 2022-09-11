<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (session_status() == PHP_SESSION_NONE) // Verifica se a sessao foi inicializada
{
    session_start();
}
if (!isset($_SESSION["nome"])) {
    header('Location: singin.php');
}

include '../App/Controllers/TaskController.php';

use App\Controllers\TaskController;

$taskController = new TaskController();
$tasks = $taskController->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php include 'layout/header.php' ?>
    <title>Tarefas: Easyjur Task</title>
</head>

<body>
    <?php include 'layout/menu.php' ?>
    <div class="container-fluid">
        <div class="content-box">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista das suas últimas tarefas cadastradas <div class="button-insert">
                            <button data-toggle="modal" data-target="#modalInsert" type="button" class="btn btn-success">Criar Tarefa</button>
                            <a style="margin-left: 10px;" type="button" class="btn btn-danger" href="../routes/pdf.php?type=alltask" target="_blank" title="PDF Tarefa"><svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                    <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                    <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                </svg>Gerar PDF de todas tarefa</a>
                            <a style="margin-left: 10px;" type="button" class="btn btn-success" href="../routes/excel.php?type=alltask" target="_blank" title="PDF Tarefa"><svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z" />
                                                </svg>Gerar Excel de todas tarefa</a>
                        </div>
                    </h5>
                    <div id="injectVizualizar">

                    </div>
                    <div id="injectEditar">

                    </div>
                    <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalInsertLabel">Nova tarefa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="task_name" class="col-form-label">Título:</label>
                                            <input type="text" maxlength="100" class="form-control required" id="task_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="task_description" class="col-form-label">Descrição:</label>
                                            <textarea maxlength="400" rows="15" class="form-control required" id="task_description"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button id="createTask" type="button" class="btn btn-success">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tabela" class="table">
                            <thead>
                                <tr>
                                    <th width="15%">Titulo Tarefa</th>
                                    <th width="30%">Descrição</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Data de Criação</th>
                                    <th width="10%">Data de Conclusão</th>
                                    <th width="15%">Gerenciar</th>
                                </tr>
                            </thead>
                            <tbody width="100%">
                                <!-- pdf.php?type=task&task_id=18 color: green;" -->
                                <?php foreach ($tasks as $task) : ?>

                                    <?php $task = str_replace("'", "", $task); ?>
                                    <tr>
                                        <td><?php echo $task['task_name']; ?></td>
                                        <td><?php echo substr($task['task_description'], 0, 60) . '...'; ?></td>
                                        <td><?php echo $task['status'] == "pendente" ? '<div class="custom-status-pendente text-center">' . $task['status'] . '</div>' : '<div class="custom-status-concluido text-center">' . $task['status'] . '</div>'; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($task['create_at'])); ?></td>
                                        <td><?php echo $task['date_conclusion'] == NULL ? "Não concluida" : date('d/m/Y', strtotime($task['date_conclusion'])); ?></td>
                                        <td>
                                            <a onclick="modalVizualizar(<?php echo $task['task_id'] ?>)" data-jsondados='<?php echo json_encode($task); ?>' id="btn-task-<?php echo $task['task_id'] ?>" href="#" title="Vizualização Completa"><svg style="color: orange;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg></a>
                                            <a href="../routes/pdf.php?type=task&task_id=<?php echo $task['task_id'] ?>" target="_blank" title="PDF Tarefa"><svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                                    <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                                    <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                                </svg></a>
                                            <a href="../routes/excel.php?type=task&task_id=<?php echo $task['task_id'] ?>" target="_blank" title="Excel Tarefa"><svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z" />
                                                </svg></a>
                                            <?php if ($task['status'] != 'concluido') : ?>
                                                <a onclick="modalEdit(<?php echo $task['task_id'] ?>)" data-jsondados='<?php echo json_encode($task, JSON_PRETTY_PRINT); ?>' id="btn-task-edit-<?php echo $task['task_id'] ?>" title="Editar" href="#"><svg style="color: blue;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg></a>
                                                <a onclick="modalDelete(<?php echo $task['task_id'] ?>)" href="#" title="Deletar"><svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg></a>
                                                <a onclick="modalConcluir(<?php echo $task['task_id'] ?>)" title="Concluir Tarefa" href="#"><svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                                    </svg></a>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot width="100%">
                                <tr>
                                    <th width="15%">Titulo Tarefa</th>
                                    <th width="30%">Descrição</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Data de Criação</th>
                                    <th width="10%">Data de Conclusão</th>
                                    <th width="15%">Gerenciar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php' ?>
    <script>
        $(document).ready(function() {
            // Data Table
            table = $('#tabela').DataTable({
                "responsive": true,
                "pageLength": 10,
                "oLanguage": {
                    "sUrl": "assets/json/pt_br.json"
                },
                "aaSorting": [],
            });


            // Envia dados para criar tarefa
            $('#createTask').click(function(e) {
                e.preventDefault();
                var validacao = validate();
                if (validacao) {
                    var formData = new FormData();
                    formData.append('task_name', $('#task_name').val());
                    formData.append('task_description', $('#task_description').val());
                    Swal.fire({
                        icon: 'warning',
                        confirmButtonText: "Confirmar",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        title: "Inserir tarefa?"
                    }).then((response) => {
                        if (response.value) {
                            $.ajax({
                                type: "POST",
                                url: "../routes/apitasks.php?type=insert",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: (response) => {
                                    console.log(response)
                                    let data = JSON.parse(JSON.stringify(response))
                                    if (data.status == '201') {
                                        Swal.fire({
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 2000,
                                            title: data.message
                                        })
                                        setTimeout(
                                            function() {
                                                window.location.href = "singin.php";
                                            }, 2000);
                                    } else {
                                        Swal.fire({
                                            icon: "warning",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            title: data.message
                                        })
                                    }
                                },
                                error: (response) => {
                                    if (response.responseJSON.status == 422) {
                                        $('#msmError').css('display', 'block');
                                        $('#msmError').html(response.responseJSON.message);
                                    }
                                }
                            })
                        }
                    })
                }
            })

            // Validação Insert
            function validate() {
                try {
                    var count = 0;
                    $('.required').each(function(i) {
                        if (this.value == "") {
                            $(this).css('border-color', 'red');
                            count++;
                        } else {
                            $(this).css('border-color', '#ced4da');
                        }
                    })
                    if (count > 0) {
                        throw "Os campos em vermelho são obrigatórios."
                    } else {
                        $('#msmError').css('display', 'none');
                    }
                    if (count > 0) {
                        return false;
                    } else {
                        return true;
                    }
                } catch (error) {
                    $('#msmError').css('display', 'block');
                    $('#msmError').text(error);
                }
            }

        });

        // Modal edição de tarefa
        function modalEdit(task_id) {
            let dadosModal = $('#btn-task-edit-'.concat(task_id)).data('jsondados');
            let html = `
                    <div class="modal fade" id="modalEdit_${task_id}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel_${task_id}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel_${task_id}">Editando: ${dadosModal.task_name}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="task_name_${task_id}" class="col-form-label">Título:</label>
                                            <input type="text" class="form-control maxlength="100" required-edit-${task_id}" value="${dadosModal.task_name}" id="task_name_${task_id}">
                                        </div>
                                        <div class="form-group">
                                            <label for="task_description_${task_id}" class="col-form-label">Descrição:</label>
                                            <textarea maxlength="400" rows="15" class="form-control required-edit-${task_id}" id="task_description_${task_id}">${dadosModal.task_description}</textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button" data-edittask="${task_id}" id="editTaskButton" type="button" class="btn btn-success">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
            `;
            $('#injectEditar').html(html);
            $('#modalEdit_' + task_id).modal('show');

            // Função validar dados edit
            function validateEdit(id) {
                try {
                    var count = 0;
                    $('.required-edit-' + id).each(function(i) {
                        if (this.value == "") {
                            $(this).css('border-color', 'red');
                            count++;
                        } else {
                            $(this).css('border-color', '#ced4da');
                        }
                    })
                    if (count > 0) {
                        throw "Os campos em vermelho são obrigatórios."
                    } else {
                        $('#msmError').css('display', 'none');
                    }
                    if (count > 0) {
                        return false;
                    } else {
                        return true;
                    }
                } catch (error) {
                    $('#msmError').css('display', 'block');
                    $('#msmError').text(error);
                }
            }

            // Envia dados tarefa
            $('#editTaskButton').click(function(e) {
                e.preventDefault();
                var validacao = validateEdit($(this).data('edittask'));
                if (validacao) {
                    var formData = new FormData();
                    formData.append('task_name', $('#task_name_' + $(this).data('edittask')).val());
                    formData.append('task_description', $('#task_description_' + $(this).data('edittask')).val());
                    formData.append('task_id', $(this).data('edittask'));
                    Swal.fire({
                        icon: 'warning',
                        confirmButtonText: "Confirmar",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        title: "Alterar tarefa?"
                    }).then((response) => {
                        if (response.value) {
                            $.ajax({
                                type: "POST",
                                url: "../routes/apitasks.php?type=update",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: (response) => {
                                    console.log(response)
                                    let data = JSON.parse(JSON.stringify(response))
                                    if (data.status == '200') {
                                        Swal.fire({
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 2000,
                                            title: data.message
                                        })
                                        setTimeout(
                                            function() {
                                                window.location.href = "singin.php";
                                            }, 2000);
                                    } else {
                                        Swal.fire({
                                            icon: "warning",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            title: data.message
                                        })
                                    }
                                },
                                error: (response) => {
                                    if (response.responseJSON.status == 422) {
                                        $('#msmError').css('display', 'block');
                                        $('#msmError').html(response.responseJSON.message);
                                    }
                                }
                            })
                        }
                    })
                }
            })
        }


        // Modal Vizualizar Tarefa
        function modalVizualizar(task_id) {
            let dadosModal = $('#btn-task-'.concat(task_id)).data('jsondados');
            let data_criacao = new Date(dadosModal.create_at).toLocaleDateString();
            console.log(dadosModal.date_conclusion);
            let data_conclusao = dadosModal.date_conclusion == null || dadosModal.date_conclusion == '' ? "Não concluida" : new Date(dadosModal.date_conclusion).toLocaleDateString()
            let html = `
            <div class="modal fade" id="modalVizualizar" tabindex="-1" role="dialog" aria-labelledby="modalVizualizarTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">${dadosModal.task_name}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>Descrição: </strong><p>${dadosModal.task_description}</p>
                            <strong>Status</strong><p style="${dadosModal.status == 'pendente' ? 'color: orange' : 'color:green'}">${dadosModal.status}</p>
                            <strong>Data Criação</strong><p>${data_criacao}</p>
                            <strong>Data Conclusao</strong><p>${data_conclusao}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $('#injectVizualizar').html(html);
            $('#modalVizualizar').modal('show');
        }

        // Modal confirmar delete
        function modalDelete(id) {
            console.log(id)
            Swal.fire({
                icon: 'warning',
                confirmButtonText: "Confirmar",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                title: "Deseja realmente deletar está tarefa?"
            }).then((response) => {
                if (response.value) {
                    $.ajax({
                        type: "POST",
                        url: "../routes/apitasks.php?type=delete&id=" + id,
                        processData: false,
                        contentType: false,
                        success: (response) => {
                            console.log(response)
                            let data = JSON.parse(JSON.stringify(response))
                            if (data.status == '200') {
                                Swal.fire({
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: data.message
                                })
                                setTimeout(
                                    function() {
                                        window.location.href = "singin.php";
                                    }, 2000);
                            } else {
                                Swal.fire({
                                    icon: "warning",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    title: data.message
                                })
                            }
                        },
                        error: (response) => {
                            if (response.responseJSON.status == 422) {
                                $('#msmError').css('display', 'block');
                                $('#msmError').html(response.responseJSON.message);
                            }
                        }
                    })
                }
            })
        }

        // Modal confirmar atualização
        function modalConcluir(id) {
            console.log(id)
            Swal.fire({
                icon: 'warning',
                confirmButtonText: "Confirmar",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                title: "Deseja realmente concluir está tarefa?"
            }).then((response) => {
                if (response.value) {
                    $.ajax({
                        type: "POST",
                        url: "../routes/apitasks.php?type=status&id=" + id,
                        processData: false,
                        contentType: false,
                        success: (response) => {
                            console.log(response)
                            let data = JSON.parse(JSON.stringify(response))
                            if (data.status == '200') {
                                Swal.fire({
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: data.message
                                })
                                setTimeout(
                                    function() {
                                        window.location.href = "singin.php";
                                    }, 2000);
                            } else {
                                Swal.fire({
                                    icon: "warning",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    title: data.message
                                })
                            }
                        },
                        error: (response) => {
                            if (response.responseJSON.status == 422) {
                                $('#msmError').css('display', 'block');
                                $('#msmError').html(response.responseJSON.message);
                            }
                        }
                    })
                }
            })
        }
    </script>
</body>

</html>