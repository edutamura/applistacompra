<?php

define('HOST', 'localhost');
define('USUARIO','listacompras');
define('SENHA', 'lista1234#');
define('DB','listacompras');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Erro ao conectar');

?>