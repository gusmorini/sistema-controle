<div class="panel panel-default">

	<div class="panel-heading">
        Informações do cliente
    </div>

	<div class="panel-body">
    <?php
        foreach($ficha as $f):

        $id_cli = $f->ide_cli;
        $nome = $f->nom_cli;
        $end = ($f->end_cli == '' ? '...' : $f->end_cli);
        $tel = ($f->tel_cli == '' ? '...' : $f->tel_cli);
        if($f->tip_cli == 1){
            $label_1 = 'RG';
            $doc_1 = $f->item1;
            $label_2 = 'CPF';
            $doc_2 = $f->item2;
        }else{
            $label_1 = 'CNPJ';
            $doc_1 = $f->item1;
            $label_2 = 'I.E';
            $doc_2 = $f->item2;
        }
        endforeach;
    ?>
    <div class="row" style="line-height: 30px;">
        <div class="col-sm-12"><strong><?= $nome ?></strong></div>
        <div class="col-sm-6">END: <?= $end ?></div>
        <div class="col-sm-6">TEL: <?= $tel ?></div>
        <div class="col-sm-6"><?= "$label_1 : $doc_1" ?></div>
        <div class="col-sm-6"><?= "$label_2 : $doc_2" ?></div>
    </div>

</div> <!-- panel-body -->
</div><!-- panel -->

<div class="panel panel-default">
    <div class="panel-body">

<div class="btn-group btn-group-justified" role="group" aria-label="..." style="margin-bottom: 10px;">
  <div class="btn-group" role="group">
    <button type="button" id="btn_debitos" class="btn btn-default">Débitos</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" id="btn_historico" class="btn btn-default">Histórico</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" id="btn_alterar" class="btn btn-default">Alterar</button>
  </div>  
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">Ordem</button>
  </div>  
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">Recibo</button>
  </div>
</div>

<div id="submenu" ></div>

</div>
</div>

<script type="text/javascript">

    $('#submenu').load('<?=base_url("clientes/tela_ficha_debitos/".$id_cli) ?>');
    
    $('#btn_debitos').click(function(){
        tela_debitos();
    });    

    $('#btn_historico').click(function(){
        tela_historico();
    });    

    $('#btn_alterar').click(function(){
        tela_alterar();
    });

    function tela_historico(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_historico/".$id_cli) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

    function tela_alterar(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_alterar_pessoa/".$id_cli) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

    function tela_debitos(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_debitos/".$id_cli) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

</script>