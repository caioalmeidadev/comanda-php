<?php
$produto  = new acme\models\consumoModel();
$grupos   = $produto->readGrupos();

if(isset($_POST['novo']))
{
    $pedido =  new \acme\models\consumoModel();
	if (($_POST['total'] == null) || ($_POST['total'] == 'NaN')){
		
		echo '<div class="ui segment">
				<h1>
					<center>
						Código digitado está incorreto!
					</center>
				</h1>
			</div>';
		
	} else {
		$fimPedido = $pedido->realizaPedido($_POST['cod_produto'],$_POST['valor'],$_POST['qtde'],$_POST['total'],$_POST['cod_mesa']);
		if($fimPedido > 0)
		{
			echo '
			<div class="ui segment">
				<h1>
					<center>
						Pedido realizado com sucesso!
					</center>
				</h1>
			</div>';

		}

	}
}

?>
<div>

	<div name="docNovo" id="docNovo">
	
	<!-- Seleção por Código -->

		<form method="post" action="" class="ui form segment" name="formcodigo" id="formcodigo" onsubmit="return false">
		 
				<div class="ui input" >
					<input type="text" placeholder="Código ..." name="SelecaoCodigo" id= "SelecaoCodigo" >						
				</div>
		</form>
		
		
		
        <form method="post" id="campos" class="ui form segment"  enctype="multipart/form-data" >
            <input type="hidden" name="novo" value="sim">
            <input type="hidden" name="cod_produto">
            <input type="hidden" name="cod_mesa" value="<?php echo $_GET['cod_mesa'];?>">

			
			<div class="field" onsubmit="return false">
				<label>Produto</label>
				<label class="ui raised segment" name="NomeProduto" id="NomeProduto" ></label>
			</div>
	
			
            <div class="field" onsubmit="return false">
            <label>Quantidade</label>
            <input type="text" name="qtde" value="1.00"  > 
			</div>
			
			<div class="field" onsubmit="return false">
            <label>Valor</label>
            <input type="text" name="valor" placeholder="0.00" >
			</div>
			
			<div class="field" onsubmit="return false">
            <label>Total</label>
            <input type="text" name="total" placeholder="0.00" >
			</div>
			
        <button name="btnconfirmar"  id="btnconfirmar" class="ui button" type="submit" >Confirmar</button>
    </form>
	</div>
</div>

	<div class="ui basic modal">
    <i class="close icon"></i>
    <div class="header">
        Processado com sucesso
    </div>
    <div class="image content">
        <div class="image">
            <i class="archive icon"></i>
        </div>
        <div class="description">
            <p>Your inbox is getting full, would you like us to enable automatic archiving of old messages?</p>
        </div>
    </div>
    <div class="actions">
        <div class="two fluid ui inverted buttons">
            <div class="ui red basic inverted button">
                <i class="remove icon"></i>
                No
            </div>
            <div class="ui green basic inverted button">
                <i class="checkmark icon"></i>
                Yes
            </div>
        </div>
    </div>
	</div>
