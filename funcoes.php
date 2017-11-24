<?php
require 'config/cfg.php';


if (isset($_POST['codProduto'])) {

if(isset($_POST['addProduto'])) {
    $produto = new acme\models\consumoModel();
    $p = $produto->findByProduto($_POST['codProduto']);
    $retornoDados = array();
    foreach ($p as $p2)
    {
    $retornoDados['PRECOVENDA'] = $p2->PRECOVENDA;
    $retornoDados['PRODUTO'] = $p2->PRODUTO;
    $retornoDados['UNIDADE'] = $p2->UNIDADE;
    $retornoDados['CODIGO'] = $p2->CODIGO;
    }

    echo json_encode($retornoDados);
}

} else {
	
	if(isset($_POST['addProduto'])) {
    $produto = new acme\models\consumoModel();
    $p = $produto->findByProduto($_POST['produto']);
    $retornoDados = array();
    foreach ($p as $p2)
    {
    $retornoDados['PRECOVENDA'] = $p2->PRECOVENDA;
    $retornoDados['PRODUTO'] = $p2->PRODUTO;
    $retornoDados['UNIDADE'] = $p2->UNIDADE;
    $retornoDados['CODIGO'] = $p2->CODIGO;
    }

    echo json_encode($retornoDados);
}

}



if(isset($_POST['grupo']))
{
    $produtoGrupo = new \acme\models\consumoModel();
    $produtos = $produtoGrupo->readProdutoByGrupo($_POST['codGrupo']);

    echo json_encode($produtos);

}

?>