<?php

//cria os parâmetros de conexão com o Banco de Dados
define('HOST', 'localhost');
define('USUARIO', 'sysListaCompras');
define('SENHA', 'sysListaCompras');
define('DB', 'listacompras');

//cira a conexão com o Banco de Dados usando os parâmetros definidos
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

//monta a query a ser executada no Banco de Dados e preenche o resultado na variável
$query = "select idItem, nomeItem from item";
$resultado = mysqli_query($conexao, $query);


echo "<strong>Lista:</strong><br>";
//imprime todas as linhas da tabela e coloca os checkbox com o value = id do item na tabela do banco de dados
if (mysqli_num_rows($resultado) > 0){

    echo '<form method="POST" action="removerItem.php">';
    while($row = mysqli_fetch_assoc($resultado)){
        
        echo '<input type="checkbox" name="_item[]" value="' . $row["idItem"] . '">' . $row["nomeItem"] . "<br>";
    }
    echo '<br><input type="submit" value="Remover selecionados">';
    echo "</form>";
} else {
    echo "Não há resultados";
}

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" value="Voltar" name="_voltar">
</form>

<?php

if(isset($_POST['_voltar']) == 'Voltar'){
    mysqli_close($conexao);
    header('Location: /index.php');
} else if(isset($_POST['_item']) <> 0){
    $item = $_POST['_item'];
    foreach($item as $i) {
        $query = "delete from item where idItem = '$i'";
        mysqli_query($conexao, $query);
    }
    header('Location: /removerItem.php');
}


?>