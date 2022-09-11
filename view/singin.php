<?php
if(session_status() == PHP_SESSION_NONE) // Verifica se a sessao foi inicializada
{
    session_start();
}
if(isset($_SESSION["nome"])){
    header('Location: tasks.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php include 'layout/header.php' ?>
    <title>Login: Easyjur Task</title>
</head>

<body>
    <?php include 'layout/menu.php' ?>
    <div class="container">
        <div class="content-box">
            <div class="card">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="card-body">
                            <form>
                                <h5 class="card-title">Login</h5>
                                <p class="card-text text-right" id="msmError" style="color:red; display:none"></p>
                                <div class="form-group">
                                    <label for="login">Login:</label>
                                    <input type="text" class="form-control required" maxlength="50" id="login" placeholder="Infome seu login">
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control required" maxlength="60" id="password" placeholder="Infome sua senha">
                                </div>
                                <div class="button-form d-flex justify-content-center">
                                    <button id="enviaDados" class="btn btn-primary">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img width="100%" src="assets/image/task-image2.jpg" alt="Logo EasyJur">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php' ?>
    <script>
        $(document).ready(function() {
            // Ajax envia cadastro
            $('#enviaDados').click(function(e) {
                e.preventDefault();
                var validacao = validate();
                if (validacao) {
                    var formData = new FormData();
                    formData.append('login', $('#login').val());
                    formData.append('senha', $('#password').val());

                    $.ajax({
                        type: "POST",
                        url: "../routes/apiusers.php?type=login",
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
                                        window.location.href = "tasks.php";
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
                            if(response.responseJSON.status == 401){
                                $('#msmError').css('display', 'block');
                                $('#msmError').html(response.responseJSON.message);
                            }
                        } 
                    })
                }

            })
            // Validacoes formulario
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
    </script>
</body>

</html>