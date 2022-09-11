<?php
if (session_status() == PHP_SESSION_NONE) // Verifica se a sessao foi inicializada
{
    session_start();
}
if (isset($_SESSION["nome"])) {
    header('Location: tasks.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php include 'layout/header.php' ?>
    <title>Registrar: Easyjur Task</title>
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
                                <h5 class="card-title">Cadastre-se</h5>
                                <p class="card-text">Preencha os campos abaixo para completar o cadastro.</p>
                                <p class="card-text text-right" id="msmError" style="color:red; display:none"></p>
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control required" id="nome" maxlength="100" placeholder="Infome seu nome completo.">
                                </div>
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control required" id="cpf" maxlength="16" placeholder="Infome seu CPF.">
                                </div>
                                <div class="form-group">
                                    <label for="telefone">Telefone:</label>
                                    <input type="text" class="form-control required" id="telefone" maxlength="17" placeholder="Infome seu telefone.">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control required" id="email" maxlength="80" placeholder="Infome seu e-mail.">
                                </div>
                                <div class="form-group">
                                    <label for="login">Login:</label>
                                    <input type="text" class="form-control required" id="login" maxlength="50" placeholder="Infome seu login.">
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha:</label>
                                    <input type="password" class="form-control required" id="password" maxlength="60" placeholder="Infome sua senha">
                                </div>
                                <div class="button-form d-flex justify-content-center">
                                    <button id="enviaDados" class="btn btn-success">Registrar</button>
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
                    formData.append('name', $('#nome').val());
                    formData.append('cpf', $('#cpf').val());
                    formData.append('telefone', $('#telefone').val());
                    formData.append('email', $('#email').val());
                    formData.append('login', $('#login').val());
                    formData.append('senha', $('#password').val());
                    Swal.fire({
                        icon: 'warning',
                        confirmButtonText: "Confirmar",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        title: "Deseja confirmar seu cadastro?"
                    }).then((response) => {
                        if (response.value) {
                            $.ajax({
                                type: "POST",
                                url: "../routes/apiusers.php?type=insert",
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

            $("#cpf").blur(function() {
                try {
                    let cpfValidate = validarCPF($('#cpf').val());
                    if (!cpfValidate) {
                        $('#msmError').css('display', 'block');
                        $('#cpf').css('border-color', 'red');
                        throw "CPF invalido!";
                    } else {
                        $('#cpf').css('border-color', '#ced4da');
                        $('#msmError').css('display', 'none');
                    }
                } catch (error) {
                    $('#msmError').css('display', 'block');
                    $('#msmError').text(error);
                }
            });
            $("#email").blur(function() {
                try {
                    let emailValidate = validateEmail($('#email').val());
                    if (!emailValidate) {
                        $('#msmError').css('display', 'block');
                        $('#email').css('border-color', 'red');
                        throw "E-mail invalido!";
                    } else {
                        $('#email').css('border-color', '#ced4da');
                        $('#msmError').css('display', 'none');
                    }
                } catch (error) {
                    $('#msmError').css('display', 'block');
                    $('#msmError').text(error);
                }
            });

            // Somente letras campo nome
            $("#nome").on("input", function() {
                var regexp = /[^a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]/g;
                if (this.value.match(regexp)) {
                    $(this).val(this.value.replace(regexp, ''));
                }
            });

            // Mascara telefone
            $('#telefone').mask('(00) 0000-00009');
            $('#telefone').blur(function(event) {
                if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                    $('#telefone').mask('(00) 00000-0009');
                } else {
                    $('#telefone').mask('(00) 0000-00009');
                }
            });

            // Mascara cpf
            $('#cpf').mask('000.000.000-00')
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
                    let cpfValidate = validarCPF($('#cpf').val());
                    let emailValidate = validateEmail($('#email').val())
                    if (!cpfValidate) {
                        $('#msmError').css('display', 'block');
                        $('#cpf').css('border-color', 'red');
                        throw "CPF invalido!";
                        count++;
                    } else {
                        $('#cpf').css('border-color', '#ced4da');
                        $('#msmError').css('display', 'none');
                    }
                    if (!emailValidate) {
                        $('#msmError').css('display', 'block');
                        $('#email').css('border-color', 'red');
                        throw "E-mail invalido!"
                        count++;
                    } else {
                        $('#email').css('border-color', '#ced4da');
                        $('#msmError').css('display', 'none');
                    }
                    let validaS = validaSenha($('#password').val());
                    if (!validaS) {
                        $('#msmError').css('display', 'block');
                        $('#password').css('border-color', 'red');
                        throw "Sua senha deve ter letras, letras maiuculas e números!"
                        count++;
                    } else {
                        $('#password').css('border-color', '#ced4da');
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

            // Validação de Email
            function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }

            function validaSenha(senha) {
                // verifica se tem 6 caracteres ou mais
                if (senha.match(/.{6,}/)) {
                    passo = true;
                } else {
                    passo = false;
                }
                // verifica se tem ao menos uma letra maiúscula
                if (senha.match(/[A-Z]{1,}/)) {
                    passo1 = true;
                } else {
                    passo1 = false;
                }
                // verifica de tem ao menus um número
                if (senha.match(/[0-9]{1,}/)) {
                    passo2 = true;
                } else {
                    passo2 = false;
                }
                // e todos os passos devem ser verdadeiros para validar
                if (passo && passo1 && passo2) {
                    return true;
                } else {
                    return false;
                }
            }

            // Validação de CPF
            function validarCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g, '');
                if (cpf == '') return false;
                // Elimina CPFs invalidos conhecidos	
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999")
                    return false;
                // Valida 1o digito	
                add = 0;
                for (i = 0; i < 9; i++)
                    add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
                // Valida 2o digito	
                add = 0;
                for (i = 0; i < 10; i++)
                    add += parseInt(cpf.charAt(i)) * (11 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(10)))
                    return false;
                return true;
            }
        });
    </script>
</body>

</html>