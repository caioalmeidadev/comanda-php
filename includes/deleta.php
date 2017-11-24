<?php

if(isset($_POST['delete']))
{
    $deletar = new acme\models\consumoModel();
    $deletado = $deletar->cancelaProduto($_GET['cod_produto'],$_GET['cod_mesa']);

    if($deletado){
        echo '<div class="ui segment">
		<center>
    <h1>
        Procedimento realizado com sucesso!
    </h1>
    <div>
    <a class="ui red button" href="./index.php">Voltar para o Inicio</a>
		</center>
	</div>
</div>';
    }else
    {
        echo '<div class="ui segment">
		<center>
    <h1>
        Ocorreu um erro ao cancelar o produto!
    </h1>
    <div>
    <a class="ui red button" href="./index.php">Voltar para o Inicio</a>
	</div>
	</center>
</div>';
    }
}
else
{
?>
<center>
<form method="post">
<div class="ui segment">
    <h4 class="ui blue inverted header">
       Excluir Item da Comanda
    </h4>
</div>
<div>
    Deseja excluir o item <?php echo  $_GET['cod_produto']?> da mesa <?php echo $_GET['cod_mesa']?>?
</div>
<div class="ui segment">
<button class="ui green button">Deletar</button>
    <input type="hidden" name="delete"/>
</div>
</form>
</center>
<?php } ?>