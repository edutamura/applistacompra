<?php

define('HOST', 'us-cdbr-east-06.cleardb.net');
define('USUARIO','bd633b219fc125');
define('SENHA', '9efd6f04');
define('DB','heroku_9c64e6b5f3a5cf6');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Erro ao conectar');

?>