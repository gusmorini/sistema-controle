<?php

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
          
      } //fecha foreach


?>

<input type="hidden" name="id" id="id" value="<?= $id ?>">

<div class="row">
    <div class="form-group col-sm-4">
        <label>Código</label>
        <input type="text" name="id" class="form-control off" value="<?= $id ?>">
    </div>
    <div class="form-group col-sm-8">
        <label>data</label>
        <input type="date" name="data" class="form-control off" value="<?= $data ?>">
    </div>
</div>


<div class="form-group">
    <label>nome</label>
    <input type="text" name="nome" id="nome" class="form-control off" value="<?= $nome ?>">
</div>
<div class="form-group">
    <label>telefone</label>
    <input type="text" name="telefone" id="telefone" class="form-control off phone" value="<?= $tel ?>">
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea name="desc" id="desc" class="form-control off" rows="5" style="resize: none;"><?= $txt ?></textarea>
</div>    


<script type="text/javascript">

    $('.phone').mask('00000-0000 00000-0000',{reverse:true});
    
    $('.off').prop("disabled",true);
    $('#btn_update').hide();
    $('#btn_arquivar').show();
    $('#btn_editar').show();

    $('#btn_editar').click(function(){

        $('#btn_update').show();
        $('#btn_editar').hide();
        $('#btn_arquivar').hide();

        $('#nome').prop("disabled",false);
        $('#telefone').prop("disabled",false);
        $('#desc').prop("disabled",false);

    });

    $('#btn_reativar').click(function(){
        
       var ide_lem = $('#id').val(); 
        
        $.ajax({
            url: '<?=base_url()?>os/reativar_ordem/'+ide_lem,
            success: function(data){
                fecha_modal();
                tela_arquivo();
                aviso('Re-ativado');
            }

        });

    });     


</script>