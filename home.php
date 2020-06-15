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
//session_start();

//verifica se a sessão foi iniciada, ou seja, se o usuário fez o login corretamente antes de acessar o sistema
include('login/verificaSessao.php');

//adicionar conexão com o banco de dados
include('banco/conexao.php');

include('item/removerItemSimples.php');

//monta a query a ser executada no Banco de Dados e preenche o resultado na variável
$query = "select idItem, descricao, quantidade from item";
$resultado = mysqli_query($conexao, $query);

//Abre divs para centralizar o resultado da lista
echo '<html><div class="container">';
echo '<div class="row justify-content-center">';

//echo '<div class="row"><strong>Lista:</strong><br></div>';


//imprime todas as linhas da tabela

echo '<table class="table table-hover">';
echo '<thead> 
        <tr>
            <th>Item</th>
            <th>Quantidade</th>
            <th>Check</th>
            <th>Opções</th>
        </tr>
       </thead>';
echo '<tbody>';
if (mysqli_num_rows($resultado) > 0){
    while($row = mysqli_fetch_assoc($resultado)){
        echo '<tr>';
        echo '<td>' . $row["descricao"] . '</td>';
        echo '<td align="left">' . $row["quantidade"] . '</td>';
        echo '<td> '. '<input type="checkbox">' . ' </td>';
        echo '<td><form method="POST" action="home.php">';
        echo '<button type="submit" class="btn-primary" value="$row["idItem"]" name="_alterarItem">Alterar</button>' . '  ' . 
        '<button type="submit" class="btn-danger" value="' . $row["idItem"] . ' " name="_removerItemSimples">Remover</button>';
        echo '</form></td>';
        echo '</tr>';
    }
} else {
    echo "Não há resultados<br><br>";
}
echo '</tbody>
    </table>';
//Fecha as divs abertas no 'echo'

echo '</div>';
echo '</div>';

//fecha a conexão com o Banco de Dados


//echo "entrou!"


echo '<div class="container">
        <div class="row justify-content-center">
            <br>
            <form method="POST" action="home.php">
                <input class="col btn btn-lg btn-primary btn-block" type="submit" value="Incluir item" name="_adicionarItem">

                <input class="col btn btn-lg btn-primary btn-block" type="submit" value="Remover vários itens" name="_removerItem">
            </form>           
        </div>
    </div>  
    <br><h5><a href="/login/logout.php">Sair</a></h5>  
    </html>';

switch(true){

    case isset($_POST['_removerItemSimples']):
        $i = $_POST['_removerItemSimples'];
        removerItemSimples($i, $conexao);
        header('Location: home.php');
        break;

    case isset($_POST['_adicionarItem']):
        //fecha a conexão com o Banco de Dados
        mysqli_close($conexao);
        header('Location: /item/adicionarItem.php');
        break;
    
    case isset($_POST['_removerItem']):
        //fecha a conexão com o Banco de Dados
        mysqli_close($conexao);
        header('Location: /item/removerItem.php');
        break;
}

echo "<br>Usuário logado: " . $_SESSION['usuario'];

mysqli_close($conexao);

?>
