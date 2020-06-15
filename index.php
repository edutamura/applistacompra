<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!--Fim Bootstrap-->
        <title>Lista de Compras</title>        
    </head>

    <body>
        <div class="container p-3">
            <!--
            <div class="row justify-content-center">
                <h1 class="h3 mb-3 font-weight-normal">Lista de compras</h1>
            </div>
            -->
            <div class="row justify-content-center">
                <img src="/CSS/img/logo_index.jpg">
            </div>
            <div class="row justify-content-center">
                <h1 class="h3 mb-3 font-weight-normal">Lista de compras</h1>
            </div>

            <div class="row justify-content-center">
                <div class="jumbotron">
                    <div class="row justify-content-center">
                        <h1 class="h5 mb-3 font-weight-normal">Faça seu login</h1>
                    </div>
                    <div class="row justify-content-center">
                        <form class="form-signin" action="/login/login.php" method="POST">
                            <div class="form-group">
                                <!--
                                <label>Usuário</label>
                                -->
                                <input name="usuario" placeholder="Seu usuário" autofocus="" class="form-control">
                            </div>
                            <div class="form-group">
                                <!--
                                <label>Senha</label>
                                -->
                                <input name="senha" type="password" placeholder="Sua senha" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botão de cadastrar usuário está desativado para evitar cadastros indesejados
        <form action="formularioCadastroUsuario.php" method="POST">
            <br><button name="cadastrar">Cadastrar usuário</button>
        </form>
        -->
        
    </body>
</html>