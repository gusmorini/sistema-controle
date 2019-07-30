<?php 

	$data = $recibo['data'];
	$desc = $recibo['desc'];
	$nome = $recibo['nome'];
	$valor = $recibo['valor'];
	$extenso = $recibo['extenso'];



?>

<div class="panel panel-default">
  <div class="panel-heading">
	<h3 class="text-center">
		<strong>Informática Morini</strong> <br>
		<small>Av. Paraná 1581 - Centro - Maria Helena - PR	</small>
	</h3>  	
  </div>
  <div class="panel-body">

	<h2 class="text-center">RECIBO</h2>

	<div class="list-group" >

	<div class="list-group-item">
		<?php 
			echo "Recebemos de <strong>$nome</strong> <br> a importância de <strong>R$ ".$valor." </strong> 
			<i>($extenso)</i> <br> Referente a: $desc.";
		?>
	</div>

	</div>

	<br><br>
	<h5 class="text-center">
		_________________________________________________
		<br>
		<br>
		Responsável
		
	</h5>

	<h5 class="text-center">
		<?= 'Maria Helena - '.data_ext($data) ?>
	</h5>
	

</div>
</div>

<button type="submit" class="btn btn-default" id="btn_imprimir">imprimir</button>


