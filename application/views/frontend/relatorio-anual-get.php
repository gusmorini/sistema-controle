  <?php 
    
    $this->table->set_heading("Mês","Entrada","Saida","Balanço");
    
    $anoRel = $ano;
    
    $total_entrada = 0;
    $total_saida = 0;

    for ($i = 1; $i <= 12; $i++) 
    {
        $mesRel = str_pad($i, 2, "0", STR_PAD_LEFT);
        $inicio = $anoRel."-".$mesRel."-01";
        $final = $anoRel."-".$mesRel."-31";
        switch($i)
        {
			case 1: $nomeMes = "Janeiro";   break;
			case 2: $nomeMes = "Fevereiro"; break;
			case 3: $nomeMes = "Março"; break;
			case 4: $nomeMes = "Abril"; break;
			case 5: $nomeMes = "Maio";  break;
			case 6: $nomeMes = "Junho"; break;
			case 7: $nomeMes = "Julho"; break;
			case 8: $nomeMes = "Agosto";    break;
			case 9: $nomeMes = "Setembro";  break;
			case 10: $nomeMes = "Outubro";  break;
			case 11: $nomeMes = "Novembro"; break;
			case 12: $nomeMes = "Dezembro"; break;
        }

          $resultado = $this->admin_model->teste_controle($inicio,$final);

          $entrada = 0;
          $saida = 0;

          foreach($resultado as $r){
            if($r->tip_cont == 'entrada')
            {
                $entrada = $entrada + $r->val_cont;
            }
            else
            {
                $saida = $saida + $r->val_cont;
            }
          }
          $this->table->add_row("$nomeMes",'R$ '.dinheiro($entrada),'R$ '.dinheiro($saida),'R$ '.dinheiro($entrada-$saida));
          $total_entrada = $total_entrada + $entrada;
          $total_saida = $total_saida + $saida;

      $ent = dinheiro($total_entrada);
      $sai = dinheiro($total_saida);
      $bal = dinheiro($total_entrada - $total_saida);

     

      }//for

    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate(); 

    if($anoRel < date('Y')){
      $media = ($total_entrada-$total_saida)/12;
    }
    else{
      $media = ($total_entrada-$total_saida)/date('m');
    }

    $med = dinheiro($media);

     echo "Média balanço anual: R$ $med";

?> 

<script type="text/javascript">
  
    var ent = '<?= $ent ?>';
    var sai = '<?= $sai ?>';
    var bal = '<?= $bal ?>';
    var med = '<?= $med ?>';

    $('#ent').html('R$ '+ent);
    $('#sai').html('R$ '+sai);
    $('#bal').html('R$ '+bal);

</script>