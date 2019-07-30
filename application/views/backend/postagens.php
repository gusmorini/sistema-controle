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
                   <?= 'Adicionar nova '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">','</div>');
                        echo form_open('admin/postagens/inserir');
                        $id = $this->session->userdata('userlogado')->id;
                        ?>
                        <input type="hidden" name="txt-autor" id="txt-autor" value="<?=$id?>">
                        <div class="form-group">
                        <label id="txt-categoria">Categoria</label>
                        <select id="txt-categoria" name="txt-categoria" class="form-control">
                            <?php
                            foreach($categorias as $cat){
                            ?>
                            <option value='<?=$cat->id?>'> <?=$cat->titulo?> </option>
                            <?php
                            }//foreach
                            ?>
                        </select>
                        </div> 
                        <div class="form-group">
                        <label id="txt-titulo">Título</label>
                        <input type="text" id="txt-titulo" name="txt-titulo" class="form-control" placeholder="Digite o título" value="<?=set_value('txt-titulo')?>">
                        </div> 
                        <div class="form-group">
                        <label id="txt-subtitulo">Subtítulo</label>
                        <input type="text" id="txt-subtitulo" name="txt-subtitulo" class="form-control" placeholder="Digite o título" value="<?=set_value('txt-subtitulo')?>">
                        </div>                        
                        <div class="form-group">
                        <label id="txt-conteudo">Conteúdo</label>
                        <textarea id="txt-conteudo" name="txt-conteudo" class="form-control"><?=set_value('txt-conteudo')?></textarea>
                        </div>                         
                        <button type="submit" class="btn btn-default">Cadastrar</button>
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
                   <?= 'Alterar '.$subtitulo.' existente' ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                            $this->table->set_heading("Foto","Título","Alterar","Excluir");
                            foreach($postagens as $postagem){
                                $titulo = $postagem->titulo;
                                $fotopost = "foto";
                                $data = postadoem($postagem->data);
                                $alterar = anchor(base_url('admin/postagens/alterar/'.md5($postagem->id)),'<i class="fa fa-refresh fa-fw"></i> Alterar');
                                $excluir = anchor(base_url('admin/postagens/excluir/'.md5($postagem->id)),'<i class="fa fa-remove fa-fw"></i>Excluir');
                                $this->table->add_row($fotopost,$titulo,$alterar,$excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
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
