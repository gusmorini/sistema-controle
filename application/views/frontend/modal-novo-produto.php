<!-- MODAL á vista -->
<div class="modal fade" id="modal_cadastro">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Novo cadastro</span>
        </div><!-- modal-header -->

      <div class="modal-body">

        <?php
            echo form_open('',array('id'=>'form_cad','autocomplete'=>'off')  );
        ?>

        <div class="form-group">
        <label>Tipo</label>
                <select class="form-control" id="tipo" name="tipo">
                  <option value="1">Produto</option>
                  <option value="2">Serviço</option>
                </select>
      </div>  

      <div class="form-group">
        <label>Descrição</label>
                <input type="text" name="desc" class="form-control" >
      </div>        
      <div class="form-group">
        <label>Custo R$</label>
                <input type="text" name="custo" class="form-control money" >
      </div>

      <div id="campo-01">
        <div class="form-group">
          <label>QTD mínima</label>
                  <input type="number"  name="minima" min="0" class="form-control" value="1" >
        </div>        
        <div class="form-group">
          <label>QTD estoque</label>
                  <input type="number" name="qtd" min="0" class="form-control" value="1" >
        </div>
        <div class="form-group" >
          <label>Lucro R$</label>
                  <input type="text" name="lucro" class="form-control money" >
        </div>        
      </div><!-- campo 1 -->

        </div><!-- modal-body -->

        <div class="modal-footer">
           <button type="submit" id='btn_cad' class="btn btn-default">cadastrar</button>
        </div><!-- modal.footer -->
        
        <?php

            echo form_close();

        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">

    $('#btn_cad').click(function(){

        var id_form = '#form_cad';
        var local = '<?= base_url('estoque/salvar') ?>';

        if($('#tipo').val() == 1){
          alert('1');
        }else{
          alert('2');
        }

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
                     aviso('item duplicado');
                    }else{
                      $(id_form)[0].reset();
                      fecha_modal();
                      tela_lista();
                      aviso('Cadastrado');
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