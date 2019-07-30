<div class="col-sm-9">

<div class="panel panel-default">
  <div class="panel-heading">
	<h3 class="text-center">
		<strong>Informática Morini</strong> <br>
		<small>Av. Paraná 1581 - Centro - Maria Helena - PR	</small>
	</h3>  	
  </div>
  <div class="panel-body">

	<h2 class="text-center">RECIBO</h2>

	<div class="list-group" >

		<div class="list-group-item">Recebemos de <strong id="res-nome" ></strong> </div>
		<div class="list-group-item">
			A importância de <strong>R$  <span id="res-valor"></span> </strong> <i>, <span id="res-extenso"></span> </i>
		</div>
		<div class="list-group-item">
			Referente a: <span id="res-desc"></span>
		</div>

		</div>

	<br><br><br>
	<h5 class="text-center">
		_________________________________________________
		<br>
		<br>
		Responsável
		
	</h5>

	<h5 class="text-center">
		Maria Helena <span id="res-data"></span>
	
	</h5>
	

</div>
</div>
</div><!-- col -->

<div class="col-sm-3 no-print">
	<div class="panel panel-default">
		<div class="panel-heading">Gerar Recibo</div>
		<div class="panel-body">

			  <div class="form-group">
					<label>Data</label>
	                <input type="date" name="data" id="data" class="form-control" value="<?= data_usa() ?>">
			  </div>
			  <div class="form-group">
					<label>Nome </label>
	                <input type="text" name="nome" class="form-control campo">
			  </div>			  
			  <div class="form-group">
					<label>Descrição</label>
					<textarea name="desc" class="form-control campo" rows="2"></textarea>
			  </div>			  
			  <div class="form-group">
					<label>Valor R$</label>
	                <input type="text" name="valor" class="form-control money campo">
			  </div>			  
			  <div class="form-group">
					<label>Extendo</label>
	                <input type="text" name="extenso" class="form-control campo">
			  </div>

				<button type="button" class="btn btn-default" id="btn_imprimir">imprimir</button>

		</div>
	</div>
</div><!-- col -->

<script type="text/javascript">
	
	$('.money').mask('000.000.000.000.000,00', {reverse: true});
	
	$('#btn_imprimir').click(function(){

		window.print();

	});

//escreve data por extenso
   
function dataExt(data) {

   meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
   semana = new Array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");      

  
  	var data_hoje = data+' 00:00 ';

   hoje = new Date(data_hoje);

   dia = hoje.getDate();
   dias = hoje.getDay();
   mes = hoje.getMonth();
   ano = hoje.getYear();

     if (navigator.appName == "Netscape"){
       ano = ano + 1900;
     }   
   
   diaext = dia + " de " + meses[mes]
   + " de " + ano;

   return diaext;

}// data por extenso

	var data = $('#data').val();

	console.log( dataExt(data) );

	$('#data').change(function(){
		
		$('#res-data').html( dataExt($(this).val()));
	});


	$('#res-data').html( dataExt(data) );

	$('.campo').keyup(function(){

		var valor = $(this).val();
		var nome = $(this).attr('name');

		$('#res-'+nome).html(valor);

		console.log(valor+' - '+nome);
	});

</script>