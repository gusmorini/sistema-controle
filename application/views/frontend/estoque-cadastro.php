        <?php
        echo form_open('',array('id'=>'form_cad','autocomplete'=>'off')  );
        ?>

        <div class="form-group col-sm-4">
				<label>Tipo</label>
                <select class="form-control" id="tipo" name="tipo">
                	<option value="1">Produto</option>
                	<option value="2">Serviço</option>
                </select>
		  </div>	

		  <div class="form-group col-sm-4">
				<label>Descrição</label>
                <input type="text" name="desc" class="form-control" >
		  </div>			  
		  <div class="form-group col-sm-4">
				<label>Custo R$</label>
                <input type="text" name="custo" class="form-control money" >
		  </div>

		  <div id="campo-01">
			  <div class="form-group col-sm-4">
					<label>QTD mínima</label>
	                <input type="number"  name="minima" min="0" class="form-control" value="1" >
			  </div>			  
			  <div class="form-group col-sm-4">
					<label>QTD estoque</label>
	                <input type="number" name="qtd" min="0" class="form-control" value="1" >
			  </div>
			  <div class="form-group col-sm-4">
					<label>Lucro R$</label>
	                <input type="text" name="lucro" class="form-control money" >
			  </div>			  
		  </div><!-- campo 1 -->		  

		  <div class="col-sm-12">
			<button type="submit" id='btn_cad' class="btn btn-default">cadastrar</button>
		  </div>		  	  

        <?php
        echo form_close();
        ?> 

	<div id="alerta" class="pull-right"></div>

<script type="text/javascript">

		$('#btn_cad').click(function(){

        var id_form = '#form_cad';
        var local = '<?= base_url('estoque/salvar') ?>';

        $(id_form).validate({
           
            rules:{
                desc:{required:true},
                custo:{required:true, valor_min:true},
                lucro:{required:true},
                minima:{required:true, min:0},
                qtd:{required:true, min:0}
            },

            submitHandler: function(form){
                
		        $.ajax({
	                url: local,
	                method:'post',
	                data: $(id_form).serialize(),                             
	                success: function (data){
	                	if(data == ''){
							$('#alerta').html('item já cadastrado');
	                	}else{
	                		aviso('Cadastrado');
	                		$(id_form)[0].reset();
	                	}
	                }
	            });//AJAX

            }//submit

        });//validate

    });//btn

	    $( "#tipo" ).change(function() {
		  if($('#tipo').val() == 2){
		  	$('#campo-01').hide();
		  }else{
			$('#campo-01').show();
		  }
		});

	    $('.money').mask('000.000.000.000.000,00', {reverse: true});


</script>