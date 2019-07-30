<script type="text/javascript">
  
    $(document).ready(function(){
      
      $('.money').mask('000.000.000.000.000,00', {reverse: true});
      
    });

</script>

<?php 

    foreach($ficha_detalhes as $row):

        $id = $row->ide_pro;
        $data = $row->dat_pro;
        $desc = str_replace('#', '| ', $row->des_pro);
        $val = $row->val_pro;
        $obs = ($row->obs_pro == '' ? '...' : $row->obs_pro); 
        $ven = conta_vencida($data,data_usa());

?>

<div class="panel panel-default">
    
    <div class="panel-heading">Ficha detalhes</div>

        <ul class="list-group">
        <li class="list-group-item"><strong class="text-primary">Código </strong> <?= $id ?> </li>
        <li class="list-group-item"><strong class="text-primary">Descrição </strong><?= $desc ?></li>  
        <li class="list-group-item"><strong class="text-primary">Observação </strong><?= $obs ?></li>
        <li class="list-group-item"><strong class="text-primary">Data </strong><?= data_ext($data) ?></li>
        <li class="list-group-item"><strong class="text-primary">Vencido </strong><?= $ven ?></li>
        <li class="list-group-item"><strong class="text-primary">Valor </strong><?= 'R$ '.dinheiro($val) ?></li>
        </ul>

        <div class="panel-body">
                

<?php

    endforeach;

    foreach($ficha as $row){ $nome = $row->nom_cli; $ide_cli = $row->ide_cli; }

?>
     <a href="<?= base_url('clientes/ficha/'.md5($ide_cli).'/4/'.$id) ?>" class="btn btn-default">Alterar promissória</a>
        </div> <!-- panel-body -->
</div><!-- panel -->     
<?php
    echo form_open(base_url('vendas/receber_unica'),array('class'=>'form-inline'));
    echo form_hidden('nome',$nome);
    echo form_hidden('ide_pro',$id);
    echo form_hidden('ide_cli',$ide_cli);
    echo form_hidden('val_pro',$val);
?>

<div class="panel panel-default">
  <div class="panel-heading">
      <h3 class="panel-title">Receber valor desta promissória</h3>
    </div>

  <div class="panel-body text-center">
      <div class="form-group">
        <!-- <label>Busca</label> -->
        <input type="date" name="data" class="form-control" value="<?= data_usa() ?>" required>
      </div>       
      <div class="form-group">
      <!-- <label>Busca</label> -->
      <input type="text" name="valor" class="form-control money" placeholder="R$ 0,00" required>
      </div>                      
    <button type="submit" name="registrar" class="btn btn-success">Receber</button>        
  </div> <!-- panel-body -->
</div><!-- panel -->


<!-- <div class="col-lg-6 no-print">
  <div class="form-group">
    <input type="date" name="data" class="form-control" placeholder="Jane Doe" value="<?= data_usa() ?>" required>
  </div>
  <div class="form-group">
    <input type="text" name="valor" class="form-control"placeholder="R$ 0,00" style="width: 100px;" onkeyup="maskIt(this,event,'###.###.###,##',true)" required>
  </div>
  <button type="submit" class="btn btn-success">receber</button>
</div> -->
<?php
    echo form_close();
?>



