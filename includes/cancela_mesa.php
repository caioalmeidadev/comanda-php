<?php

if(isset($_POST['cancela']))
{
	$deletar = new acme\models\comandaModel();
	$deletado = $deletar->limpaMesa($_GET['cod_mesa']);

	if($deletado){
		echo '<div class="ui segment">
	<center>
	<h1>
		Procedimento realizado com sucesso!
	</h1>
	<div>
	<a class="ui red button" href="./index.php">Voltar para o Inicio</a>
	</div>
	</center>

</div>';
	}else
	{
		echo '<div class="ui segment">
	<h1>
	<center>
		Ocorreu um erro ao cancelar! <br> A comanda '.$_GET['cod_mesa'].' não está em aberto. 
	</center>
	</h1>
	<div>
	<center>
	<a class="ui red button" href="./index.php">Voltar para o Inicio</a>
	</center>
	</div>

</div>';
	}
}
else
{
?>
<form method="post">
<center>
	<div class="ui segment">
		<h4 class="ui blue inverted header">
		   CANCELAR COMANDA
		</h4>
	</div>
	<div>
	  <h4>Deseja cancelar a comanda: <?php echo $_GET['cod_mesa']?>?</h4>
	</div>
	<div class="ui segment">
		<button class="ui green button">Cancelar</button>
		<input type="hidden" name="cancela"/>
	</div>
</center>
</form>
<?php } ?>