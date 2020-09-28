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
require_once(dirname(__FILE__).'/login/verificaSessao.php');

//adicionar conexão com o banco de dados
require_once(dirname(__FILE__).'/banco/conexao.php');

//require_once('item/removerItemSimples.php');

require_once(dirname(__FILE__).'/item/controleItem.php');

//monta a query a ser executada no Banco de Dados e preenche o resultado na variável
$query = "select idItem, descricao, status, quantidade from item";
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
        if($row['status'] == 1){
            echo '<tr style="background-color:lightgrey;">';
        }
        else{
            echo '<tr>';
        }
        
        //alterar
        if($auxAlterarItem == true && $row['idItem'] == $idItemAlterar){
            echo '<form method="POST" action="/item/controleItem.php">';
            echo '<td><input type="text" name="_nomeItem" value="' . $row['descricao'] . '"> </td>';
            echo '<td><input type="text" name="_quantidadeItem" value="' . $row['quantidade'] . '"> </td>';
            if($row['status'] == '1'){
                echo '<td><input value="Devolver" type="submit" name="_checkItemNull"></td>';
                //echo '<input type="image" src="/CSS/img/selecaoS3.jpg" value="homer2" name="_checkItem">';
            }
            else{
                echo '<td><input type="image" src="/CSS/img/selecaoN3.jpg" name="_checkItem"></td>';
            }
            //echo '<td> '. '<input type="checkbox">' . ' </td>';
            echo '<td>';
            echo '<input type="hidden" name="_idItemAlterar" value="' . $row["idItem"] . '">';
            echo '<button type="submit" class="btn-info" name="_alterarItem">Confirmar</button>' . '  ' . 
            '<button type="submit" class="btn-danger" value="' . $row["idItem"] . ' " name="_removerItemSimples">Remover</button>';
            echo '</td></form>';
        }
        //normal
        else{
            
            echo '<td>' . $row["descricao"] . '</td>';
            echo '<td align="left">' . $row["quantidade"] . '</td>';            
            if($row['status'] == '1'){         
                echo '<td><form method="POST" action="/item/controleItem.php">';       
                echo '<input type="hidden" value="' . $row['idItem'] . '" name="_checkItemId">';
                echo '<input type="hidden" value="' . $row['status'] . '" name="_checkItemStatus">';
                echo '<input type="submit" value="Devolver" name="_checkItem">';
                //echo '<input type="image" src="/CSS/img/selecaoS3.jpg" value="homer2" name="_checkItem">';
                echo '</form></td>';
                //echo '<input type="hidden" name="_statusItemAlterar" value="' . $row['status'] . '">';
            }
            else{
                echo '<td><form method="POST" action="/item/controleItem.php">';
                echo '<input type="hidden" value="' . $row['idItem'] . '" name="_checkItemId">';
                echo '<input type="hidden" value="' . $row['status'] . '" name="_checkItemStatus">';
                echo '<input type="submit" value="Pegar" name="_checkItem">';
                //echo '<input type="image" src="/CSS/img/selecaoN3.jpg" name="_checkItem">';
                //echo '<input type="hidden" name="_statusItemAlterar" value="' . $row['status'] . '">';
                echo '</form></td>';
            }
            
            //echo '<td> '. '<input type="checkbox">' . ' </td>';
            echo '<td><form method="POST" action="home.php">';
            echo '<button type="submit" class="btn-primary" value="'. $row["idItem"] . '" name="_editarItem">Alterar</button>' . '  ' . 
            '<button type="submit" class="btn-danger" value="' . $row["idItem"] . ' " name="_removerItemSimples">Remover</button>';
            echo '</form></td>';            
        }
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
echo '</html>';
?>

<html>
    <div class="container">
        <div class="row justify-content-center">
            <br>
            <form method="POST" action="/item/controleItem.php">
                <input type="hidden" name="_idItemAlterar" value="<?php echo $idItemAlterar; ?>">
                <div class="form-group">
                    <label>Nome item:</label>
                    <input type="text" name="_nomeItem" class="form-control" value="<?php echo $nomeItemAlterar; ?>">
                </div>
                <div class="form-group">
                    <label>Quantidade item:</label>
                    <input type="text" name="_quantidadeItem" class="form-control" value="<?php echo $quantidadeItemAlterar; ?>">
                </div>
                <div class="form-group">
                    <?php
                        if($auxAlterarItem == true):
                    ?>
                    <!--<input class="col btn btn-lg btn-info btn-block" type="submit" value="Alterar item" name="_alterarItem">-->
                    <button type="submit" class="col btn btn-lg btn-info btn-block" name="_alterarItem">Alterar item</button>
                    <?php
                        else:
                    ?>                    
                    <input class="col btn btn-lg btn-primary btn-block" type="submit" value="Incluir item" name="_adicionarItem">
                    <?php 
                        endif; 
                    ?>

                    <input class="col btn btn-lg btn-primary btn-block" type="submit" value="Remover vários itens" name="_removerItem">
                </div>
            </form>           
        </div>
    </div>  
    <br><h5><a href="/login/logout.php">Sair</a></h5>  
</html>

<?php

echo "<br>Usuário logado: " . $_SESSION['usuario'];

mysqli_close($conexao);

?>
