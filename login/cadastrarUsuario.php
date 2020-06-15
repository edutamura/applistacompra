<?php

include('../banco/conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha']) || empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['confirmarsenha'] || empty($_POST['codigoverificador']))){
    
    exit();
} elseif ($_POST['senha'] <> $_POST['confirmarsenha']) {
    
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$codigoverificador = $_POST['codigoverificador'];

//verifica se já existe usuário cadastrado com o mesmo usuário
$validaCadastrado = "select * from usuario where usuario = '{$usuario}'";
$resultadoValidaCadastrado = mysqli_query($conexao, $validaCadastrado);
$row = mysqli_num_rows($resultadoValidaCadastrado);

if($row <> 0 || $codigoverificador <> 'bizung@1'){
    echo 'Usuário já existe ou o código de verificação está errado';
    exit();
} else {
    //cria a query para chamar a procedure
    $cadastraUsuario = "CALL cadastrarUsuario('{$usuario}', md5('{$senha}'), '{$nome}', '{$sobrenome}', '{$email}')";
    //executa a query no banco de dados
    mysqli_query($conexao, $cadastraUsuario);
    header('Location: ../index.php');
}

?>