<?php
require 'config/cfg.php';
session_start();
if(isset($_POST['atendente']))
{
    $_SESSION['cod'] =  $_POST['atendente'];
}


?>
<!doctype html>
<!-- Alteração para versão 1.0.0.5 - 03/06/2016 por Paulo -->

<!-- Alteração para versão 1.0.0.3 - 12/04/2016 por Caio
        Corrigido o textbox com o valor dos produtos na pagina novo.php
		
	Alteração para versão 1.0.0.4 - 02/06/2016 por Paulo
		Busca por código na tela de inserção de produtos em novo.php
		
	Alteração para versão 1.0.0.5 - 03/06/2016 por Paulo
		Preencher código digitado com zeros a esquerda (000000), com 6 de tamanho em jva_script.js	
		Tecla enter pular os campos em jva_script.js
		Validação do código com informações do banco de dados em novo.php
-->
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>JVA Comanda - V 1.0.0.5</title>
    <link rel="stylesheet" type="text/css" href="public/assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/assets/css/jquery.mobile-1.2.0.min.css">
    
</head>
<body class="container blue lighten-2">
<script type="text/javascript" src="public/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="public/assets/js/jquery.mobile-1.2.0.min.js"></script>
<script type="text/javascript" src="public/assets/js/materialize.min.js"></script>
<script type="text/javascript" src="public/assets/js/jva_script.js"></script>

<div class="center">
    <nav class="blue lighten-2">
     <div class="nav-wrapper">
      <a class="brand-logo center" href="./index.php"><img src="./public/assets/images/logo.png" alt="" name="logo" title="logo-jva"></a>    
     </div> 
    </nav>

    
	
	<?php
		if(isset($_GET['cod_mesa'])<>0){
			echo '<h2> 
					<center>
				Comanda: '.$_GET['cod_mesa'].'
					</center>
				</h2>';
		}
		
	?>
 
 <?php


 if(isset($_SESSION['cod'])) {
     $atendente = $_SESSION['cod'];
     $_SESSION['cod'] = $atendente;
 }





    if(empty($atendente))
    {
        require 'includes/atendente.php';
    }else{

        require (isset($_GET['p'])) ? 'includes/'.$_GET['p'].'.php' : 'includes/comanda.php';



    }
 ?>

</div>

<footer>
<div class="page-footer blue darken-2">
    <div class="container">
        <div class="row">
          Compativel com: <i class="android icon"></i><i class="apple icon"></i><i class="linux icon"></i><i class="windows icon"></i>
        </div>
    </div>
    <div class="footer-copyright">
    <div class="container">
    © 2017 Desenvolvido por JVA SISTEMA
    </div>
    </div>
</div>
</footer>

</body>
</html>