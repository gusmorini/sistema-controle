<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <?= 'Alterar '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">','</div>');
                        echo form_open('admin/postagens/salvar_alteracoes');
                        foreach($postagens as $row){
                        ?>
                        <div class="form-group">
                        <label id="txt-titulo">Título</label>
                        <input type="text" id="txt-titulo" name="txt-titulo" class="form-control" placeholder="Digite o título" value="<?=$row->titulo?>">
                        </div> 
                        <div class="form-group">
                        <label id="txt-subtitulo">Subtítulo</label>
                        <input type="text" id="txt-subtitulo" name="txt-subtitulo" class="form-control" placeholder="Digite o título" value="<?=$row->subtitulo?>">
                        </div>                        
                        <div class="form-group">
                        <label id="txt-conteudo">Conteúdo</label>
                        <textarea id="txt-conteudo" name="txt-conteudo" class="form-control"><?=$row->conteudo?></textarea>
                        </div>
                        <div class="form-group">
                        <label id="txt-categoria">Categoria</label>
                        <select id="txt-categoria" name="txt-categoria" class="form-control">
                            <?php
                            foreach($categorias as $cat){
                                if($row->catid == $cat->id){
                                    $seleciona = 'selected="selected"';
                                }else{
                                    $seleciona = '';
                                }
                            ?>
                            <option value='<?=$cat->id?>' <?=$seleciona?> > <?=$cat->titulo?> </option>
                            <?php
                            }//foreach
                            ?>
                        </select>
                        </div>                         
                        <div class="form-group">
                        <label id="txt-data">Postado em</label>
                        <input type="text" id="txt-data" name="txt-data" class="form-control" placeholder="Digite o título" value="<?=postadoem($row->data)?>" disabled >
                        </div>
                        <input type="hidden" name="txt-id" id="txt-id" value="<?=$row->id?>"> 
                        <button type="submit" class="btn btn-default">Atualizar</button>
                        <?php
                        echo form_close();
                        ?>  
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->        

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <?= 'Foto destaque '.$subtitulo.'' ?>
                   <small>(para melhor resultado use uma imagem de 800x300)</small>
                </div>
                <div class="panel-body">
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-lg-12">
                    <?php
                        if($row->img == 1){
                        $src = 'assets/frontend/img/postagens/'.md5($row->id).'.jpg';
                        }else{
                        $src = 'assets/frontend/img/semFotobanner.jpg';
                        }
                    ?>
                    <img class="img-responsive" src="<?=base_url($src)?>" height="250" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php
                    echo form_open_multipart('admin/postagens/nova_foto');
                    echo form_hidden('id',md5($row->id));
                    echo '<div class="form-group">';
                    $imagem = array(    'id'=>'userfile',
                                        'name'=>'userfile',
                                        'class'=>'form-control');
                    echo form_upload($imagem);//obrigatóriamente tem que ser userfile o nome
                    echo '</div>';
                    echo '<div class="form-group">';
                    $btn = array(   'id'=>'btn_adicionar',
                                    'name'=>'btn_adicionar',
                                    'class'=>'btn btn-default',
                                    'value'=>'Adicionar nova Imagem');
                    echo form_submit($btn);
                    echo '</div>';
                    echo form_close();
                    }// fim do foreach()                       
                    ?>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- 
    <form role="form">
        <div class="form-group">
            <label>Titulo</label>
            <input class="form-control" placeholder="Entre com o texto">
        </div>
        <div class="form-group">
            <label>Foto Destaque</label>
            <input type="file">
        </div>
        <div class="form-group">
            <label>Conteúdo</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
       
        <div class="form-group">
            <label>Selects</label>
            <select class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Cadastrar</button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </form> 
-->
