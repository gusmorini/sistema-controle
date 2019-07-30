<div class="col-sm-3">
    <div class="panel panel-default">
    <div class="panel-heading">Busca ordem de serviço</div>
    <div class="panel-body">
    <?php
    echo form_open('',array('id'=>'form_busca_ordem'));
    ?>
      <div class="form-group">
            <!-- <label>Busca</label> -->
            <input type="text" id="txt-key" name="txt-key" class="form-control" autocomplete="off" 
            placeholder=" hein? " autofocus="">
      </div>                                              
        
    <?php
    echo form_close();
    ?>
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-body">
        <div class="btn-group-vertical btn-block">
        <button id="btn_cadastro" class="btn btn-default">  Nova ordem</button>
        <button id="btn_lista" class="btn btn-default">  Lista de ordens</button>
        <button id="btn_arquivo" class="btn btn-default">Arquivo</button>
        </div>
    </div>
    </div>   

</div><!-- col -->

<div class="col-sm-9">
    <div class="panel panel-default"> 

    <div class="panel-heading" id="title-panel"> </div>
    <div class="panel-body">
    	   <div id="tela">  </div>
    </div>
    </div>
</div><!-- col -->

<!-- MODAL á vista -->
<div class="modal fade" id="modal_cadastro">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <?php
        //echo form_open(base_url('vendas/venda_avista'),array('autocomplete'=>'off'));
        echo form_open('#',array('id'=>'form_cadastro','autocomplete'=>'off'));
        ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Nova ordem de serviço</span>
        </div><!-- modal-header -->

        <div class="modal-body">

            <div class="form-group">
                <label>nome</label>
                <input type="text" name="nome" id="nome" class="form-control">
            </div>
            <div class="form-group">
                <label>telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control phone">
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="desc" id="desc" class="form-control" rows="5"></textarea>
            </div> 

        </div><!-- modal-body -->

        <div id="erro" class="text-danger"></div>

        <div class="modal-footer">
            <!-- <button type="submit" id="btn_avista" class="submit btn btn-success" value="submit">Confirma</button> -->          
            <button type="submit" id="btn_cadastro" class="btn btn-success">salvar</button>       
            <!-- <button type="button" id="btn_cancel" class="btn btn-warning sr-only">cancelar</button> -->             
        </div><!-- modal.footer -->
        
        <?php
        echo form_close();
        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">
    
$('.phone').mask('00000-0000 00000-0000',{reverse:true});
    
    //busca rápida
    $('#txt-key').keyup(function(){
        var nome_form = '#form_busca_ordem';
        if($('#txt-key').val().length > 1){
            
            $.ajax({
                url: '<?=base_url()?>os/busca',
                method:'post',
                data: $(nome_form).serialize(),                             
                success: function (data)
                {
                    $('#title-panel').html('Resultado...');
                    $('#tela').html(data);
                }
            });//AJAX

        }//if
        else{
            tela_lista();
        }

    });//#txt-key  

    function tela_lista(){
        
         $('#title-panel').html('Ordens ativas');

        var local = '<?=base_url()?>os/busca';

        $.ajax({
            url: local,
            success: function(data){
                $('#tela').html(data);
            }

        });

    }   

    function tela_arquivo(){

        $('#title-panel').html('Ordens arquivadas');
        
        var local = '<?=base_url()?>os/busca_arquivo';
        $.ajax({
            url: local,
            success: function(data){
                $('#tela').html(data);
            }

        });
    } 

    tela_lista();

    $('#btn_lista').click(tela_lista);
    
    $('#btn_arquivo').click(tela_arquivo);

    $('#btn_cadastro').click(function(){

        $('#modal_cadastro').modal({
            show:true,
            keybord:false,
        });

    });

    $('#btn_cadastro').click(function(){

        var id_form = '#form_cadastro';
        var caminho = '<?=base_url()?>os/cadastro';

        $(id_form).validate({
            
            rules:{
                nome:{ required:true },
                desc:{ required:true }
            },

            messages:{
                desc:{ required:'requerido'},
                nome:{ required:'requerido'}
            },

            submitHandler: function( form ){
                
                $.ajax({
                    url: caminho,
                    method:'post',
                    data: $(id_form).serialize(),
                    success: function (data){ 
                        fecha_modal();
                        tela_lista();
                        aviso('Adicionado');
                    }                         
                });//AJAX                

            }// submitHandler
        });

    }); // btn_cadastrar
    
</script>