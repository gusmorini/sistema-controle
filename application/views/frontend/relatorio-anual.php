<div class="col-md-9">

  <div class="panel panel-default">
  <div class="panel-heading">Resultado</div>
  <div class="panel-body">

    <div id="resultado">
      <div class="text-center">
      <img src="./assets/frontend/img/pages/relatorio1.png" style="height: 300px;" >
      </div>
    </div>

  </div>
  </div>
</div>

<div class="col-md-3">
<div class="panel panel-default">
  <div class="panel-heading">Ano relatório</div>
  <div class="panel-body">

  <?php

  //$anoRel = $anorelatorio;
  
  //echo form_open('admin/rel_anual');
  echo form_open('#',array('id'=>'form_ano'));
  
  ?>
    <div class="form-group">      
    <select name="ano" id="ano" class="form-control" autofocus="">
      <option value="">  </option>
        <?php 

        $ano = date('Y');

        for($i=$ano; $i>=2011; $i--){
        
          echo "<option value='$i'>".$i."</option>";
        
        }

        ?>
    </select>    
    </div>

  <?php
    
    echo form_close();
  
  ?>
  </div>
  </div>

<!--   <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group text-success text-center">
        <?= 'Entrada: R$ '.dinheiro($total_entrada) ?>
      </div>      
      <div class="form-group text-danger text-center">
        <?= 'Saída: R$ '.dinheiro($total_saida) ?>
      </div>      
      <div class="form-group text-info text-center">
        <?= 'Balanço: R$ '.dinheiro($total_entrada-$total_saida) ?>
      </div>      
      <div class="form-group text-warning text-center">
        <?= 'Média: R$ '.dinheiro($media) ?>
      </div>
    </div>
  </div> -->

</div>

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">Resumo</div>
<div class="panel-body">

  <div id="ent" class="alert alert-success" role="alert">...</div>
  <div id="sai" class="alert alert-danger" role="alert">...</div>
  <div id="bal" class="alert alert-warning" role="alert">...</div>

</div>
</div>

<script type="text/javascript">
  
  $('#ano').change(function(){

    console.log('entrou no change');

    if($('#ano').val() != '' ){

    var id_form = '#form_ano';
    var local = '<?= base_url('admin/rel_anual_get') ?>';

    $.ajax({
    url: local,
    method:'post',
    data: $(id_form).serialize(),                             
    success: function (data)
    {
      $('#resultado').html(data);
    }
    });//AJAX 

    }//if    

  });

</script>