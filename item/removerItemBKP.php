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

include("../login/verificaSessao.php");
echo "Usuário logado: " . $_SESSION['usuario']. "<br><br>";

include("../banco/conexao.php");

//monta a query a ser executada no Banco de Dados e preenche o resultado na variável
$query = "select idItem, descricao from item";
$resultado = mysqli_query($conexao, $query);

echo '<html><div class="row justify-content-center">';
echo '<label>Lista:</label>
        <br>';
echo '<br>';
//imprime todas as linhas da tabela e coloca os checkbox com o value = id do item na tabela do banco de dados
if (mysqli_num_rows($resultado) > 0){

    echo '<form method="POST" action="removerItem.php">';
    while($row = mysqli_fetch_assoc($resultado)){
        
        echo '<input type="checkbox" name="_item[]" value="' . $row["idItem"] . '">' . $row["descricao"] . "<br>";
    }
    echo '<br><input type="submit" value="Remover selecionados">';
    echo "</form>";
} else {
    echo "Não há resultados<br><br>";
}

echo '</div></html>';

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" value="Voltar" name="_voltar">
</form>

<?php

if(isset($_POST['_voltar']) == 'Voltar'){
    mysqli_close($conexao);
    header('Location: ../home.php');
} else if(isset($_POST['_item']) <> 0){
    $item = $_POST['_item'];
    foreach($item as $i) {
        $query = "delete from item where idItem = '$i'";
        mysqli_query($conexao, $query);
    }
    header('Location: ../item/removerItem.php');
}


?>