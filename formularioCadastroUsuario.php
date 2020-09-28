<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista de Compras</title>        
    </head>

    <body>
        <h1>Cadastrar novo usuário</h1>
        
        <form action="/login/cadastrarUsuario.php" method="POST">
            <br>Dados do novo usário:
            <br><input name="nome" placeholder="Nome" autofocus="">
            <br><input name="sobrenome" placeholder="Sobrenome" autofocus="">
            <br><input name="email" placeholder="E-mail" autofocus="">
            <br><input name="usuario" placeholder="Usuário" autofocus="">
            <br><input name="senha" type="password" placeholder="Senha">
            <br><input name="confirmarsenha" type="password" placeholder="Confirmar senha">
            <br><input name="codigoverificador" type="password" placeholder="Código de verificação">
            <br><button type="submit">Cadastrar</button>
        </form>
        <form action="../index.php" method="POST">
            <br><button name="cadastrar">Voltar</button>
        </form>
    </body>
</html>

