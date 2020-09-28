<?php

require_once(dirname(__FILE__).'/../banco/conexao.php');
//require_once('banco/conexao.php');
//require_once('../login/verificaSessao.php');
require_once(dirname(__FILE__).'/../login/verificaSessao.php');
//require_once('login/verificaSessao.php');
require_once(dirname(__FILE__).'/removerItemSimples.php');

$idItemAlterar = 0;
$nomeItemAlterar = '';
$quantidadeItemAlterar = '';
$auxAlterarItem = false;



if(isset($_POST['_adicionarItem'])){
    $nomeItem = $_REQUEST['_nomeItem'];
    $quantidadeItem = $_REQUEST['_quantidadeItem'];
    if(empty($nomeItem) || empty($quantidadeItem) || $quantidadeItem < 0){
        echo "sem conteúdo";
    } else {
        //variável com a query pra inserir o nome do item no Banco de Dados
        $query = "insert into item (descricao, quantidade, status) values ('$nomeItem', '$quantidadeItem', '1')";

        //comando para executar a query
        mysqli_query($conexao, $query);
        
        echo "item adicionado: " . $nomeItem;
    }
    
    header('Location: ../home.php');
    //header('Location: /item/adicionarItem.php');
}

if(isset($_POST['_removerItem'])){
    //fecha a conexão com o Banco de Dados
    mysqli_close($conexao);
    header('Location: removerItem.php');
}

if(isset($_POST['_removerItemSimples'])){
    $i = $_POST['_removerItemSimples'];
    //removerItemSimples($i, $conexao);
    $query = "delete from item where idItem = '$i'";
    mysqli_query($conexao, $query);
    header('Location: ../home.php');
}

if(isset($_POST['_editarItem'])){
    $auxAlterarItem = true;
    $idItemAlterar = $_POST['_editarItem'];

    $query = "select * from item where idItem = $idItemAlterar";
    $resultado = mysqli_query($conexao, $query);
    
    $numRows = mysqli_num_rows($resultado);

    if($numRows == 1){
        $row = mysqli_fetch_array($resultado);
        $nomeItemAlterar = $row['descricao'];
        $quantidadeItemAlterar = $row['quantidade'];
    }

}
    
if(isset($_POST['_alterarItem'])){
    $idItemAlterar = $_POST['_idItemAlterar'];
    $nomeItemAlterar = $_POST['_nomeItem'];
    $quantidadeItemAlterar = $_POST['_quantidadeItem'];

    $query = "update item set descricao = '$nomeItemAlterar', quantidade = '$quantidadeItemAlterar' where idItem = $idItemAlterar";

    mysqli_query($conexao, $query);

    $_SESSION['auxAlterarItem'] = false;

    header('Location: ../home.php');
}

if(isset($_POST['_checkItem'])){
    //echo $_POST['_checkItemTeste'];
    //echo $_POST['_checkItemTeste2'];
    //echo $idItemCheck;
    //echo $statusItemCheck;
    //echo '<html><a href="localhost:8080/home.php">voltar</a></html>';
    
    $idItemCheck = $_REQUEST['_checkItemId'];
    $statusItemCheck = $_REQUEST['_checkItemStatus'];
    
    if($statusItemCheck == 1){
        $query = "update item set status = '0' where idItem = '$idItemCheck'";
    }
    else{
        $query = "update item set status = '1' where idItem = '$idItemCheck'";
    }
    
    mysqli_query($conexao, $query);
    
    header('Location: ../home.php');
    

}

?>