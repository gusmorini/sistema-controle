<div class="col-sm-3">

<div class="panel panel-default">
<div class="panel-heading">Informações</div>
<div class="panel-body">
        
<?php

    foreach($ficha as $f):

    $id_cli = $f->ide_cli;
    $nome = $f->nom_cli;
    $end = ($f->end_cli == '' ? '...' : $f->end_cli);
    $tel = ($f->tel_cli == '' ? '...' : $f->tel_cli);
    if($f->tip_cli == 1){
        $label_1 = 'RG';
        $doc_1 = ($f->item1 == '' ? '...' : $f->item1);
        $label_2 = 'CPF';
        $doc_2 = ($f->item2 == '' ? '...' : $f->item2);
    }else{
        $label_1 = 'CNPJ';
        $doc_1 = ($f->item1 == '' ? '...' : $f->item1);
        $label_2 = 'I.E';
        $doc_2 = ($f->item2 == '' ? '...' : $f->item2);
    }
    endforeach;
?>
<!-- informações do cliente -->
<div>
<p><?= $nome ?></p>
<p><?= $end ?></p>
<p><?= $tel ?></p>
<p><?= "$label_1 $doc_1" ?></p>
<p><?= "$label_2 $doc_2" ?></p>
</div>

<hr>

<div class="text-left">
<button type="button" id="btn_debitos" class="btn btn-default btn-block">Débitos</button>
<button type="button" id="btn_historico" class="btn btn-default btn-block">Histórico</button>
<button type="button" data-toggle="modal" data-target="#modal_alterar" class="btn btn-default btn-block">Alterar</button>
<!-- <button type="button" class="btn btn-default btn-block">Ordem</button> -->
<!-- <button type="button" class="btn btn-default btn-block">Recibo</button>     -->
</div>

</div><!-- body -->
</div><!-- panel -->

</div>