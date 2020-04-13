<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Entrar no SCPJur</title>

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/glyphicons.css" />
    <link href="css/login.css" rel="stylesheet" type="text/css">

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js" ></script>

</head>
<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>&nbsp;</h1><h1>&nbsp;</h1><h1>&nbsp;</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p><img src="images/logomedio.png" alt=""/></p>
                <p><h2>Sistema de Controle de Prazos dos Processos Jurídicos</h2></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-4 text-center">
                <form id="login-usuario" method="post" class="form-signin" >

                    <input type="hidden" name="logar">

                    <div class="input-group mb-3">
                        <label for="usu" class="input-group-text" id="basic-addon2"><span class="glyphicon glyphicon-user"></span></label>
                        <input type="text" class="form-control" id="usu" name="usu" placeholder="Digite seu Usuário">
                    </div>
                    <div class="input-group mb-3">
                        <label for="usu" class="input-group-text" id="basic-addon2"><span class="glyphicon glyphicon-asterisk"></span></label>
                        <input type="password" class="form-control" id="sen" name="sen" placeholder="Digite sua Senha" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                    <div class="row"><div class="col-md-12">&nbsp;</div></div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8"><a href="esqueci-senha.php">Esqueci a senha</a></div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                    <p class="mt-5 mb-3 text-muted">&copy; DTI 2019</p>
                </form>
            </div>
            <div class="col-md-4">&nbsp;</div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>&nbsp;</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong></strong> <span></span>
                </div>
                <div class="alert alert-warning" role="alert">
                    <strong></strong> <span></span>
                </div>
                <div class="alert alert-danger" role="alert">
                    <strong></strong> <span></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <div class="alert alert-danger" id="mensagem1" role="alert" style="display:none;">
                    <strong>Erro ao se Logar!</strong> Dados Inválidos.
                </div>
                <div class="alert alert-success" id="mensagem2" role="alert" style="display:none;">
                    <strong>Deslogado!</strong> Com Sucesso.
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>

    <script>
        $(() => {
            const formulario = $("#login-usuario");

            $(".alert").hide();

            formulario.submit(e => {
                e.preventDefault();

                let dados = serializarComoObjeto(formulario);

                $.post("login-controller.php", dados)
                .done(mensagem => {
                    if (mensagem) {
                        limparPreenchimento([ "input[name=usu]", "input[name=sen]" ]);
                        $(location).attr("href", "index.php");
                    }
                })
                .fail(erro => exibirMensagem(".alert-danger", "Erro!", "Dados Inválidos"));
            });
        });
    </script>

</body>

</html>