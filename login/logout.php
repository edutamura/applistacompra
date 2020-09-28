<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['auxAlterarItem']);
header('Location: ../index.php');
exit();
?>