  <?php

     $this->table->set_heading("Cod","Data","Nome","Descrição","...");

     foreach($arquivo as $row){

      $id = $row->ide_lem;
      $nome = $row->nom_lem;
      if($row->tel_lem !== ''){
          $tel = $row->tel_lem;    
      }else{
          $tel = "...";
      }
      $txt = $row->tex_lem;
      $data = $row->dat_lem;

      $alterar = "<a href='#' class='chama-modal' data-ide_lem='$id' ><i class='glyphicon glyphicon-paperclip'></i></a>";

      $this->table->add_row($id,data_brasil($data),$nome,$txt,$alterar);
          
      } //fecha foreach
      $this->table->set_template(array(
          'table_open' => '<table class="table table-striped">'
      ));

      echo $this->table->generate();     

  ?>

  <!-- MODAL á vista -->
<div class="modal fade" id="modal_arquivo">
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
            <span class="modal-title">Ordem de serviço arquivada</span>
        </div><!-- modal-header -->

        <div class="modal-body">

          <!-- aqui fica o conteudo dinamico -->

        </div><!-- modal-body -->

        <div id="erro" class="text-danger"></div>

        <div class="modal-footer">
            <!-- <button type="submit" id="btn_avista" class="submit btn btn-success" value="submit">Confirma</button> -->          
            <button type="submit" id="btn_reativar" data-dismiss="modal" class="btn btn-success">re-ativar</button>       
            <!-- <button type="button" id="btn_cancel" class="btn btn-warning sr-only">cancelar</button> -->             
        </div><!-- modal.footer -->
        
        <?php
        echo form_close();
        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">
  
    $('.chama-modal').click(function(){

      $('#modal_arquivo').modal({
        show:true,
        keybord:false,
      });

        var ide_lem = $(this).attr('data-ide_lem');

        $.ajax({
            url: '<?=base_url()?>os/busca_ordem_arquivo/'+ide_lem,
            success: function(data){
                $('#modal_arquivo .modal-title').html('Arquivo: '+ide_lem);
                $('#modal_arquivo .modal-body').html(data);
            }

        });

    });// chama modal   

</script>