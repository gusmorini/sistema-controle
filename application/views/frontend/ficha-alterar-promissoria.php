<div class="panel panel-default">

  <div class="panel-heading">Alterar promissória</div>

  <div class="panel-body">

  <?php

        //echo form_open(base_url('vendas/salvar_promissoria'));
        echo form_open('',array('id'=>'form_salvar_dados'));

        foreach($ficha_detalhes as $row):

        $id = $row->ide_pro;
        $ide_cli = $row->ide_cli;
        $data = $row->dat_pro;
        $desc = str_replace('#', '/ ', $row->des_pro);
        $val = $row->val_pro;
        $obs = ($row->obs_pro == '' ? '...' : $row->obs_pro); 
        $ven = conta_vencida($data,data_usa());

        echo form_hidden('ide_cli',$ide_cli);
        echo form_hidden('ide_pro',$id);

  ?>

      <div class="form-group col-sm-4">
        <label>Código</label>
        <input type="text" class="form-control" value="<?= $id ?>" disabled>
      </div>      
      <div class="form-group col-sm-4">
        <label>Data</label>
        <input type="date" class="form-control" value="<?= $data ?>" disabled>
      </div>      
      <div class="form-group col-sm-4">
        <label>Vencido</label>
        <input type="text" class="form-control" value="<?= $ven ?>" disabled>
      </div>

      <div class="form-group col-sm-12">
        <label >Descrição</label>
        <textarea style="resize: none;" class="form-control" rows="5" name="desc" id="desc" required> <?= $desc ?></textarea>
      </div>        
      <div class="form-group col-sm-6">
        <label>Observação</label>
        <input type="text" name="obs" id="obs" class="form-control" value="<?= $obs ?>" >
      </div>      
      <div class="form-group col-sm-6">
        <label>Valor R$</label>
        <input type="text" name="valor" id="valor" class="form-control money" value="<?= dinheiro($val) ?>" required>
      </div>        

      <div class="col-sm-12">
      <div class="pull-right">
        
      <button type="button" id="alterar_dados" class="btn btn-default">alterar</button>
      <!-- <button type="button" id="receber_valor" class="btn btn-success">receber</button> -->
      <button type="button" id="receber_valor" class="btn btn-success" 
      data-toggle="modal" data-target="#modal_receber">Receber</button>

      <button type="button" id="salvar_dados" class="btn btn-primary">salvar</button>      
      
      </div>
      </div>          
  
      <?php 

        endforeach;
        echo form_close();

      ?>
  </div> <!-- panel-body -->
</div><!-- panel -->

<!-- MODAL receber -->
<div class="modal fade" id="modal_receber">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">
        <?php
            echo form_open('#',array('id'=>'form_enviar','autocomplete'=>'off') );
            //echo form_open(base_url('vendas/receber_unica'),array('class'=>'form-inline'));
            echo form_hidden('ide_pro',$id);
            echo form_hidden('ide_cli',$ide_cli);
            echo form_hidden('val_pro',$val);

        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Receber Valor</span>
        </div><!-- modal-header -->

        <div class="modal-body">

            <div class="form-group">
                <label>data</label>
                <input type="date" name="data_rec" value='<?= data_usa() ?>' class="form-control">
            </div>

            <div class="form-group">
                <label>Valor R$</label>
                <input  type="text" name="val_rec" value='<?= dinheiro($val) ?>' class="form-control money">
            </div>                    
        </div><!-- modal-body -->

        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btn_enviar">Confirma</button>
        </div><!-- modal.footer -->
        <?php

            echo form_close();

        ?>
    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->


<script type="text/javascript">

  $('.money').mask('000.000.000.000.000,00', {reverse: true});

  $('#salvar_dados').click(function(){
      var id_form = '#form_salvar_dados';
      //var id_modal = '#modal_receber';
          $.ajax({
                url: ' <?= base_url('vendas/salvar_promissoria') ?> ',
                method:'post',
                data: $(id_form).serialize(),                             
                success: function (data){
                  $('#submenu').load('<?=base_url("clientes/tela_ficha_debitos/".$ide_cli) ?>');
                  //location.reload();
                }
            });//AJAX
      //$(id_modal).modal('hide');
  });//btn  

  $('#btn_enviar').click(function(){

        $("#form_enviar").validate({
            
            rules:{
                data:{ required:true },
                valor:{required:true, valor_min:true}
            },

            messages:{
                data:{ required:'data requerido'},
                valor:{required:'valor é requerido'}
            },

            submitHandler: function( form ){
                   
            var id_form = '#form_enviar';
            var id_modal = '#modal_receber';
                $.ajax({
                      url: ' <?= base_url('vendas/receber_unica') ?> ',
                      method:'post',
                      data: $(id_form).serialize(),                             
                      success: function (data){
                        $('#submenu').load('<?=base_url("clientes/tela_ficha_debitos/".$ide_cli) ?>');
                        //location.reload();
                      }
                  });//AJAX
            //$(id_modal).modal('hide');
			
			fecha_modal();
			aviso('atualizado');

            }//submitHandler

        });//validate    

  });//btn
  
  $('#salvar_dados').hide();

  $("#obs").prop("disabled",true);
  $("#valor").prop("disabled",true);
   $("#desc").prop("disabled",true);

  $('#alterar_dados').click(function(){
    
    $('#alterar_dados').hide();
    $('#receber_valor').hide();

    $('#salvar_dados').show();

    $("#desc").prop("disabled",false);
    $("#obs").prop("disabled",false);
    $("#valor").prop("disabled",false);    
  
  });

</script>