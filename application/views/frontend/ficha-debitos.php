<div class="panel panel-default">
    <div class="panel-heading">Débitos</div>
    <div class="panel-body">
<?php

    $contador = count($ficha_debito);

    if($contador > 0):

    $this->table->set_heading("Cod","Data","Descrição","Valor","Vencido"," ... ");
    
    $deb_total = 0;

    foreach($ficha_debito as $row):

        $id = $row->ide_pro;
        $id_cli = $row->ide_cli;
        $data = $row->dat_pro;
        $desc = str_replace('#', '<br>', $row->des_pro);
        $val = $row->val_pro;
        $obs = $row->obs_pro;
        if($obs == ''){
            $obs = '...';
        }

        $deb_total = $deb_total + $val;

        $ven = conta_vencida($data,data_usa());
        
        $mais = '<button class="btn btn-info btn-xs btn_mais" id="btn_'.$id.'" data-ide_pro="'.$id.'"> 
        <i class="glyphicon glyphicon-plus"></i> </button>';

        $this->table->add_row($id,data_brasil($data),$desc,'R$ '.dinheiro($val),$ven,$mais);
    
    endforeach;

    $this->table->set_template(array('table_open' => '<table class="table table-striped">'));
    echo $this->table->generate();
    echo 'Débito Total R$ '.dinheiro($deb_total);

?>
  <div class="text-right">
    <button class="btn btn-success" data-toggle="modal" data-target="#modal_receber">Receber</button>
    <button class="btn btn-default" onclick="window.print()">Imprimir</button>
  </div>

    </div><!-- body -->
</div><!-- panel -->


<!-- MODAL receber -->
<div class="modal fade" id="modal_receber">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">
        <?php
            echo form_open('#',array('id'=>'form_enviar','autocomplete'=>'off') );
            echo form_hidden('ide_cli',$id_cli);
            echo form_hidden('debito',$deb_total);

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
                <input type="date" name="data" value='<?= data_usa() ?>' class="form-control">
            </div>

            <div class="form-group">
                <label>Total</label>
                <input  type="text" name="valor" value="<?= dinheiro($deb_total) ?>" class="form-control money">
            </div>                    
        </div><!-- modal-body -->

        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button> -->
            <button type="submit" class="btn btn-success" id="btn_enviar">Confirma</button>
        </div><!-- modal.footer -->
        <?php

            echo form_close();

        ?>
    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<?php
    else:
       
       $this->load->view('frontend/nada');
      
    endif;

?>

<script type="text/javascript">
  

    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    //$('.m_dinheiro').mask("#.##0,00", {reverse: true});

    $('.btn_mais').click(function(){
      var id_pro = $(this).data('ide_pro');
      $('#submenu').load('<?=base_url("clientes/tela_ficha_mais/") ?>'+id_pro);
    });

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
                    url: ' <?= base_url('vendas/receber') ?> ',
                    method:'post',
                    data: $(id_form).serialize(),                             
                    success: function (data){
                      $('#submenu').load('<?=base_url('clientes/tela_ficha_debitos/'.$id_cli ) ?>');
                      //location.reload();
                    }
                });//AJAX
                //$(id_modal).modal('hide');
				fecha_modal();
				aviso('recebido');

            }//submitHandler

        });//validate

      });//btn


</script>