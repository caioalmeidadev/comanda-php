<?php
    $produto = new acme\models\consumoModel();
    $produtos = $produto->consumo($_GET['cod_mesa']);


    if(count($produtos) == 0 || count($produtos) == null)
    {
        $mesa   =  new acme\models\comandaModel();
        $agora  = date('d/m/y');
        $agoraH = date("H:i:s");
        if($mesa->mesaAberta($_GET['cod_mesa']) > 0)
        {

        }else {
            $aberta = $mesa->abrirMesa($_GET['cod_mesa'], $agora, $agoraH, $atendente);
        }
    }
?>

<div>
<table class="ui celled table">
    <thead>
    <tr>
        <td>Produto</td>
        <td>Qtde</td>
        <td>Valor</td>
        <td>Total</td>
        <td>Opções</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($produtos as $produto) {
      if ($produto->CANCELADO == 0) {
            echo '<tr class="positive">
        <td>'.$produto->PRODUTO.'</td>

        <td>'.number_format((string)$produto->QTDE,3, ',', '.').'</td>
        <td>'.number_format((string)$produto->UNITARIO,3, ',', '.').'</td>
        <td>'.number_format((string)$produto->TOTAL,3, ',', '.').'</td>
        <td><a href="?p=deleta&cod_produto='.$produto->COD_PRODUTO.'&cod_mesa='.$produto->COD_MESA.'" class="ui green button" ><i class="minus square icon"></i>Deletar</a>
        </td>
        </tr>';
        } else {
            echo '<tr class="negative">
        <td>'.$produto->PRODUTO.'</td>
        <td>'.number_format((string)$produto->QTDE,3, ',', '.').'</td>
        <td>'.number_format((string)$produto->UNITARIO,3, ',', '.').'</td>
        <td>'.number_format((string)$produto->TOTAL,3, ',', '.').'</td>
        <td><a href="#" class="ui red button" >DELETADO</a>
        </td>
        </tr>';
        }
    }
    ?>

    </tbody>
</table>
</div>

<div class="ui divider">
</div>
<div>
<center>
   <a href="?p=novo&cod_mesa=<?php echo $_GET['cod_mesa'] ?>" class="ui green button"><i class="add circle icon"></i>Incluir Produto </a> <a href="?p=cancela_mesa&cod_mesa=<?php echo $_GET['cod_mesa'] ?>" class="ui red button" ><i class="remove circle icon"></i> Cancelar Comanda </a>
</center>
</div>
