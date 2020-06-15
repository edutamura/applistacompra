<?php

session_start();

include('../banco/conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header('Location: ../index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

//$validaUsuario = "select idUsuario, usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";
//query para chamar a procedure 'loginUsuario' no banco de dados para validar o usuário e a senha
$validaUsuario = "CALL loginUsuario('{$usuario}', md5('{$senha}'))";

//preenche o resultado da query na variável
$resultadoValidaUsuario = mysqli_query($conexao, $validaUsuario);

//registra na variável quantas linhas retornaram da execução da query
$row = mysqli_num_rows($resultadoValidaUsuario);

if($row == 1){
    $_SESSION['usuario'] = $usuario;
    header('Location: ../home.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../index.php');
    exit();
}

?>