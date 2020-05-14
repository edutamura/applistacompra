<?php

//cria os parâmetros de conexão com o Banco de Dados
define('HOST', 'localhost');
define('USUARIO', 'sysListaCompras');
define('SENHA', 'sysListaCompras');
define('DB', 'listacompras');

//cira a conexão com o Banco de Dados usando os parâmetros definidos
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

//monta a query a ser executada no Banco de Dados e preenche o resultado na variável
$query = "select nomeItem from item";
$resultado = mysqli_query($conexao, $query);


echo "<strong>Lista:</strong><br>";
//imprime todas as linhas da tabela
if (mysqli_num_rows($resultado) > 0){
    while($row = mysqli_fetch_assoc($resultado)){
        echo $row["nomeItem"] . "<br>";    
    }
} else {
    echo "Não há resultados";
}


//fecha a conexão com o Banco de Dados
mysqli_close($conexao);

?>

<html>
    <br>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" value="Incluir item" name="_adicionarItem">
    </form>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" value="Remover item" name="_removerItem">
    </form>
    
</html>

<?php
/*
if($_SERVER["REQUEST_METHOD"] == "POST"){
    header('Location: /adicionarItem.php');
}
*/
switch(true){

    case isset($_POST['_adicionarItem']):
        //fecha a conexão com o Banco de Dados
        mysqli_close($conexao);
        header('Location: /adicionarItem.php');
        break;
    
    case isset($_POST['_removerItem']):
        //fecha a conexão com o Banco de Dados
        mysqli_close($conexao);
        header('Location: /removerItem.php');
        break;
}


?>
