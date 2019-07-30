<div class="panel panel-default">

    <div class="panel-heading">
      <h3 class="panel-title">alterar cliente</h3>
    </div>

    <div class="panel-body">

    <?php 

        echo form_open(base_url('clientes/salvar_alteracoes'));


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
            $label_1 = 'Cnpj';
            $doc_1 = $f->item1;
            $label_2 = 'I.E';
            $doc_2 = $f->item2;
        }
        $tipo = $f->tip_cli;
        
        echo form_hidden('id_md5',$id_cli_md5);
        echo form_hidden('tipo',$tipo);

    ?>
      <div class="form-group col-sm-12">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required="" value="<?= $nome ?>">
      </div>              
      <div class="form-group col-sm-6">
            <label>endereço</label>
            <input type="text" name="end" class="form-control" value="<?= $end ?>">
      </div>          
      <div class="form-group col-sm-6">
            <label>telefone</label>
            <input type="text" name="tel" class="form-control mask-1cel" value="<?= $tel ?>">
      </div>              
      <div class="form-group col-sm-6">
            <label><?= $label_1 ?></label>
            <input type="text" name="i1" class="form-control" onkeyup="maskIt(this,event,'###############')" value="<?= $doc_1 ?>">
      </div>
      <div class="form-group col-sm-6">
            <label><?= $label_2 ?></label>
            <input type="text" name="i2" class="form-control" onkeyup="maskIt(this,event,'###.###.###-##')" value="<?= $doc_2 ?>">
      </div>              

      <input type="hidden" name="tipo" value="1">

      <div class="col-sm-12">
        <button type="submit" name="registrar" class="btn btn-default">alterar</button>      
      </div>              

    <?php
        endforeach;
        echo form_close();
    ?>

    </div>
</div>