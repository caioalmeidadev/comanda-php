<?php

if(isset($_POST['addProduto']))
{

    $produto = new acme\models\consumoModel();
    $p = $produto->findByProduto($_POST['produto']);

    $retornoDados['dados'] = number_format((string)$p->PRECOVENDA,3, ',', '.');

    echo json_encode($retonoDados['dados']);
}


?>