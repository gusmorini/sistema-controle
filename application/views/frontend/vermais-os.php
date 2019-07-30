<div class="col-sm-4">
	<img src="<?= base_url('assets/frontend/img/pages/servico.png')?>" class="foto-banner">
</div>

<div class="col-sm-8">
<div class="panel panel-default" id="lembretes_add" >
	
	<div class="panel-heading"><?= $subtitulo ?></div>

	  	<ul class="list-group">
        <?php
        foreach($alterar as $row){

        $tel = $row->tel_lem;
        if($tel == ''){
        	$tel = '...';
        }

        $data = data_ext($row->dat_lem);

        ?>
        <li class="list-group-item"><strong class="text-primary">Código </strong><?= $row->ide_lem ?></li>
        <li class="list-group-item"><strong class="text-primary">Nome </strong><?= $row->nom_lem ?></li>
        <li class="list-group-item"><strong class="text-primary">Descrição </strong><?= $row->tex_lem ?></li>  
        <li class="list-group-item"><strong class="text-primary">Telefone </strong><?= $tel ?></li>
        <li class="list-group-item"><strong class="text-primary">Data </strong><?= $data ?></li>
        <?php

    	}//foreach

        ?> 
		</ul>

		<div class="panel-body">
	 	<a href="<?= base_url('os/alterarordem/'.md5($row->ide_lem)) ?>" class="btn btn-default">Editar</a>		
		</div> <!-- panel-body -->


</div><!-- panel -->
</div>