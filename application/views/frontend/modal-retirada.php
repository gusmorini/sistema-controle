  <!-- MODAL á vista -->
<div class="modal fade" id="modal_retirada">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <?php
      
            //echo form_open('admin/salvar_retirada');

            echo form_open('#',array('id'=>'form_retirada','autocomplete'=>'off'));
        ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Ordem de serviço arquivada</span>
        </div><!-- modal-header -->

        <div class="modal-body">

          <div class="form-group">
                <label>Data</label>
                <input type="date" value="<?= data_usa() ?>" name="data" class="form-control" required>
          </div>                      
          <div class="form-group">
                <label>Descrição</label>
                <textarea rows="5" name="desc" class="form-control"></textarea>
                <!-- <input type="text" name="desc" class="form-control"> -->
          </div>              
          <div class="form-group">
                <label>Valor R$</label>
                <input type="text" name="valor" class="form-control money">
          </div>          


        </div><!-- modal-body -->

        <div id="erro" class="text-danger"></div>

        <div class="modal-footer">
          
            <button type="submit" id="btn_retirada" class="btn btn-success">salvar</button>      
           
        </div><!-- modal.footer -->
        
        <?php
        echo form_close();
        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">

      $('.money').mask('000.000.000.000.000,00', {reverse: true});
    
    $('#btn_modal_retirada').click(function(){

        $('#modal_retirada').modal('show');

    });

    $('#btn_retirada').click(function(){

        var id_form = '#form_retirada';
        var caminho = '<?= base_url("admin/adicionar_retirada"); ?>';        

        $(id_form).validate({
            
            rules:{
                valor:{ required:true, valor_min:true },
                desc:{ required:true },
                data:{ required:true },
            },

            messages:{
                valor:{ required:'requerido', valor_min:'deve ser maior que zero' },
                desc:{ required:'requerido'},
                data:{ required:'requerido'},
            },

            submitHandler: function( form ){
                
                $.ajax({
                    url: caminho,
                    method:'post',
                    data: $(id_form).serialize(),
                    success: function (data){   
                        tela('admin/rel_diario','#tab_rel_diario');
                    }                            
                });//AJAX

            }// submitHandler

        });

        $('#modal_retirada').modal('hide');
        alerta('Retirada adicionada'); 

    }); // btn_retirada

</script>