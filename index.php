<?php
if(session_status() == PHP_SESSION_NONE) // Verifica se a sessao foi inicializada
{
    session_start();
}
if(isset($_SESSION["nome"])){
    header('Location: view/tasks.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home: Easyjur Task</title>
    <link rel="stylesheet" href="view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/assets/css/style.css">
</head>

<body>
<header>
    <nav class="navbar-easyjur">
        <div class="navbar-content">
            <a href="index.php">
                <div class="img-easyjur">
                    <img src="view/assets/image/logo.png" alt="Logo EasyJur">
                </div>
            </a>
            <div class="title-easyjur">
                <h1>Agendador de Tarefas - EasyJur</h1>
            </div>
            <div class="buttos-user">
                <div class="btn-easyjur">
                    <a href="view/singin.php" class="btn btn-primary">Entrar</a>
                    <a href="view/singup.php" class="btn btn-success">Registrar</a>
                </div>
            </div>
        </div>
    </nav>
</header>
    <div class="container">
        <div class="content-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="view/assets/image/task-image.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Acesse sua Conta</h5>
                            <p class="card-text">Após o acesso você poderá criar suas tarefas e gerencia-las. Para melhor controle do seu dia.</p>
                            <a href="view/singin.php" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="view/assets/image/task-image2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Cadastre-se</h5>
                            <p class="card-text">Após criar sua conta você poderá usufruir dos beneficios do Agendador de Tarefas da EasyJur.</p>
                            <a href="view/singup.php" class="btn btn-success">Registrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>