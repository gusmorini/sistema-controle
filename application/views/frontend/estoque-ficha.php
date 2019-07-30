        <?php
        //estoque/salvar_alteracoes
        //echo form_open('',array('id'=>'form_update'));
        foreach($alterar as $row){
    	$desc = $row->des_pec;
    	$id = $row->ide_pec;
    	$custo = $row->val_pec;
    	$lucro = 0;

    	echo form_hidden('id',$id);
        ?>
			
		<!-- <h4>Estoque código: <?= $id ?></h4> -->
 
		  <div class="form-group">
				<label>Descrição</label>
                <input type="text" name="desc" class="form-control desativa" value="<?= $desc ?>">
		  </div>			  
		  <div class="form-group">
				<label>Custo R$</label>
                <input type="text" name="custo" id="custo" class="form-control money desativa" 
                value="<?= dinheiro($custo) ?>">
		  </div>

		  	<?php

		  		if($row->lucro > 0){

		  		$minima = $row->min_pec;
		  		$estoque = $row->qtd_pec;
		  		$lucro = $row->lucro;

		  	?>
		  	<div class="row">
			  <div class="form-group col-sm-6">
					<label>QTD mínima</label>
	                <input type="number" min="1" name="minima" class="form-control desativa" value="<?= $minima ?>">
			  </div>			  
			  <div class="form-group col-sm-6">
					<label>QTD estoque</label>
	                <input type="number" min="0" name="qtd" class="form-control desativa" value="<?= $estoque ?>">
			  </div>
			</div>
			  <div class="form-group">
					<label>Lucro R$</label>
	                <input type="text" name="lucro" id="lucro" class="form-control money desativa" value="<?= dinheiro($lucro) ?>">
			  </div>
			 <?php

			 	}

			 ?>			  	  			  


<!-- 			<button type="button" id="btn_editar" class="btn btn-default">alterar</button>		
			<button type="button" id="btn_update" class="btn btn-success sr-only">salvar</button>		
			<button type="button" id="btn_cancel" class="btn btn-warning sr-only">cancelar</button>	 -->	


        <?php
    	} // foreach
        /*echo form_close();*/
        ?> 

<script type="text/javascript">
	
$(document).ready(function(){

	$('.money').mask('000.000.000.000.000,00', {reverse: true});

	$('#btn_update').hover(function(){

		$("#form_update").validate({
            
            rules:{
                desc:{		required:true	},
                minima:{	required:true, min: 1	},
                qtd:{		required:true, min: 0 	},
                custo:{		required:true, 	valor_min:true	},
                lucro:{		valor_min:true	}
            },

            messages:{
                desc:{ required:'requerido'},
                qtd:{ required:'requerido', min:'deve ser maior que zero'},
                minima:{ required:'requerido', min:'ser maior que 1'},
                custo:{ required:'requerido', valor_min:'deve ser maior que zero'},
                lucro:{valor_min:'deve ser maior que zero'}
            },

            submitHandler: function( form ){
                
				var id_form = '#form_update';
				var caminho = '<?= base_url("estoque/salvar_alteracoes"); ?>';
		        $.ajax({
		            url: caminho,
		            method:'post',
		            data: $(id_form).serialize(),                             
		            success: function (data)
		            {
		            	$(id_form).trigger('reset');
		            	fecha_modal();
		            	tela_lista();
		            }
		        });//AJAX

            }// submitHandler
        });

    });//btn


	$('.desativa').prop("disabled",true);
	$('#btn_update').hide();
	$('#btn_editar').show();

	$('#btn_editar').click(function(){

		$('#btn_update').show();
		$('#btn_editar').hide();
		
		$('.desativa').prop("disabled",false);

	});

});

</script>