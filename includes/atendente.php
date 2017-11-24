<div class="row">
 <div class="col s12 m6">
  <div class="card blue-grey darken-1">
   <div class="card-content white-text">
    <span class="card-title">Escolha o atendente:</span>
    <a class="dropdown-button btn" href="#" data-beloworigin="true" data-activates="dropdown_atendentes"> Selecionar </a>
    <ul id="dropdown_atendentes" class="dropdown-content">
	 <?php
		$atendente = new \acme\models\userModel;
		$atendentes = $atendente->read();
		 foreach($atendentes as $atendente):?>
	<li><a href="#!"><?= $atendente->NOME ?></a></li>
<!-- <li value="<?php echo $atendente->CODIGO?>"><?php echo $atendente->NOME ?></li> -->
	 <?php endforeach; ?>
    </ul>
   </div>
   <div class="card-action">
    <button class="waves-effect waves-light btn"><i class="material-icons">check</i> Selecionar </button>
   </div>
  </div>
 </div>
</div>