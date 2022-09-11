<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(session_status() == PHP_SESSION_NONE) // if session status is none then start the session
{
    session_start();
}
if(!isset($_SESSION["nome"])){
    header('Location: singin.php');
} else {
    if($_SESSION["admin"] == 'nao'){
        header('Location: tasks.php');
    }
}

include '../App/Controllers/UserController.php';
use App\Controllers\UserController;
$userController = new UserController();
$users = $userController->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php include 'layout/header.php' ?>
    <title>Usúarios: Easyjur Task</title>
</head>

<body>
    <?php include 'layout/menu.php' ?>
    <div class="container-fluid">
        <div class="content-box">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista dos últimos usúarios cadastrados</h5>
                    <div class="table-responsive">
                        <table id="tabela" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody width="100%">
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?php echo $user['user_id']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['login']; ?></td>
                                        <td><?php echo $user['admin']; ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot width="100%">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Nivel</th>
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
            table = $('#tabela').DataTable({
                "responsive": true,
                "pageLength": 10,
                "oLanguage": {
                    "sUrl": "assets/json/pt_br.json"
                }
            });
        });
    </script>
</body>

</html>