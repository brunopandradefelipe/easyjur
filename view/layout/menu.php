<?php
if(session_status() == PHP_SESSION_NONE) // Verifica se a sessao foi inicializada
{
    session_start();
}
?>
<header>
    <nav class="navbar-easyjur">
        <div class="navbar-content">
            <a href="../index.php">
                <div class="img-easyjur">
                    <img src="assets/image/logo.png" alt="Logo EasyJur">
                </div>
            </a>
            <?php if(isset($_SESSION['nome'])): ?>
            <ul class="list-item-menu" type="none">
                <a class="menu-link-logged" href="tasks.php"><li>Tarefas</li></a>
                <?php if($_SESSION['admin'] == 'sim'): ?>
                    -
                <a class="menu-link-logged" href="users.php"><li>Usúarios</li></a>
                <?php endif; ?>
            </ul>
            <?php else: ?>
            <div class="title-easyjur">
                <h1>Agendador de Tarefas - EasyJur</h1>
            </div>
            <?php endif; ?>
            <div class="buttos-user">
                <div class="btn-easyjur">
                    <?php if(isset($_SESSION['nome'])): 
                        $nome = explode(' ', $_SESSION['nome'])[0];
                        ?>
                        <span style="font-weight: bold; margin-right: 5px;">Olá, <?php echo $nome; ?></span>
                        <button id="button-logout" class="btn btn-danger">Sair</button>
                    <?php else: ?>
                    <a href="singin.php" class="btn btn-primary">Entrar</a>
                    <a href="singup.php" class="btn btn-success">Registrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>