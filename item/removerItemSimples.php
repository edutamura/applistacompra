<?php


function removerItemSimples($itemId, $conexao){
    
//    include("../banco/conexao.php");
    $query = "delete from item where idItem = '$itemId'";
    mysqli_query($conexao, $query);

}


?>