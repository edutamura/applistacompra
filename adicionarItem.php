<html>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <strong>Nome item: </strong>
        <input type="text" name="_nomeItem">
        <input type="submit">
    </form>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" value="Voltar" name="_voltar">
    </form>

</html>

<?php
//função para adicionar itens ao banco de dados

//cria os parâmetros de conexão com o Banco de Dados
define('HOST', 'localhost');
define('USUARIO', 'sysListaCompras');
define('SENHA', 'sysListaCompras');
define('DB', 'listacompras');

//cira a conexão com o Banco de Dados usando os parâmetros definidos
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

//salva o nome do item na variável
if($_SERVER["REQUEST_METHOD"] == "POST"){

    switch(true){

        case isset($_POST['_nomeItem']):
            $nomeItem = $_REQUEST['_nomeItem'];
            if(empty($nomeItem)){
                echo "sem conteúdo";
            } else {
                //variável com a query pra inserir o nome do item no Banco de Dados
                $query = "insert into item (nomeItem) values ('$nomeItem')";
        
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
            header('Location: /lista.php');
    }  
}
?>

