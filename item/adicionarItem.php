<html>
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
</html>

<?php

include('../login/verificaSessao.php');
echo "Usuário logado: " . $_SESSION['usuario']. "<br><br>";

?>

<html>
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <strong>Nome item: </strong>
                <input type="text" name="_nomeItem">
                <br>
                <strong>Quantidade item: </strong>
                <input type="text" name="_quantidadeItem">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="submit" value="Voltar" name="_voltar">
            </form>
        </div>
    </div>
</html>

<?php
include("../banco/conexao.php");

//salva o nome do item na variável
if($_SERVER["REQUEST_METHOD"] == "POST"){

    switch(true){

        case isset($_POST['_nomeItem']):
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

                //fecha a conexão com o Banco de Dados
                mysqli_close($conexao);        
            }
            break;
        
        case isset($_POST['_voltar']):
            //fecha a conexão com o Banco de Dados
            mysqli_close($conexao);
            header('Location: ../home.php');
    }  
}
?>

