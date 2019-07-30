<!-- MODAL á vista -->
<div class="modal fade" id="modal_cadastro">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <?php
            echo form_open('#',array('id'=>'form_pessoa','autocomplete'=>'off')  );
        ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Novo cadastro</span>
        </div><!-- modal-header -->

        <div class="modal-body">

            <div class="form-group">
                    <label>Tipo</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="1">Pessoa Fisica</option>
                        <option value="2">Pessoa Jurídica</option>
                    </select>
              </div>    

              <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control">
              </div>              
              <div class="form-group">
                    <label>endereço</label>
                    <input type="text" name="end" class="form-control">
              </div>          
              <div class="form-group">
                    <label>telefone</label>
                    <input type="text" name="tel" class="form-control phone">
              </div>

              <div id="campo-fisica">
              <div class="form-group">
                    <label>RG</label>
                    <input type="text" name="rg" id="rg" class="m-num form-control")">
              </div>
              <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" id="cpf" class="m-cpf form-control cpf">
              </div>
              </div>          

              <div id="campo-juridica">
              <div class="form-group">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control cnpj">
              </div>
              <div class="form-group">
                    <label>I.E</label>
                    <input type="text" name="ie" id="ie" class="form-control">
              </div>
              </div>   

        </div><!-- modal-body -->

        <div id="alerta" class="text-center text-danger"></div>

        <div class="modal-footer">
            <button type="submit" id='btn_cadastrar' class="btn btn-default">cadastrar</button>
        </div><!-- modal.footer -->
        
        <?php

            echo form_close();

        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">

    $('#campo-juridica').hide();

    $( "#tipo" ).change(function() {
      if($('#tipo').val() == 2){
        $('#campo-fisica').hide();
        $('#rg').val('');
        $('#cpf').val('');
        $('#campo-juridica').show();
      }else{
        $('#campo-juridica').hide();
        $('#cnpj').val('');
        $('#ie').val('');
        $('#campo-fisica').show();
      }
    });

    $('.phone').mask('0 0000-0000');
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});

</script>