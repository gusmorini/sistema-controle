<div class="col-sm-12">
<ul class="nav nav-tabs" style="margin-bottom: 20px;">
  <li role="presentation" id="tab_rel_diario"><a href="#">Rel diário</a></li>
  <li role="presentation" id="tab_rel_anual"><a href="#">Rel anual</a></li>
  <li role="presentation" id="tab_recibo"><a href="#">Recibo</a></li>
</ul>
</div>

<?php

	include_once ("./application/views/frontend/modal-retirada.php");

?>

<div id="tela"></div>

<script type="text/javascript">

	tela('admin/rel_diario','#tab_rel_diario');

	//$('#tab_rel_anual').addClass("active");

	function tela(url,tab){

		//url local que vai chamar a pagina
		//tab id da tab active

		var local = '<?= base_url('')?>'+url;

		$.ajax({
		    url: local,
		    success: function(data){
		    	$('li').removeClass( "active" );
		        $('#tela').html(data);
		        $(tab).addClass('active');
		    }

		});
	}

	$('#tab_recibo').click(function(){

		tela('admin/tela_recibo','#tab_recibo');	
		
	});

	$('#tab_rel_anual').click(function(){

		tela('admin/rel_anual','#tab_rel_anual');	
		
	});

	$('#tab_rel_diario').click(function(){

		tela('admin/rel_diario','#tab_rel_diario');	

	});

	function alerta(i){
		$('#alerta').html(i);
	}

</script>