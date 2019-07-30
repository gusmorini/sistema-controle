<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Busca no Blog</h4>
                        <?php
                        echo form_open(base_url('busca'));
                        ?>
                    <div class="input-group">
                        <input type="text" name="txt-busca" id="txt-busca" class="form-control" autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                        <?php
                        echo form_close();
                        ?>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categorias do Blog</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                    foreach($categorias as $cat){
                                    ?>
                                    <li><a href="<?= base_url('categoria/'.$cat->id.'/'.limpar($cat->titulo)) ?>"><?=$cat->titulo?></a>
                                    </li>
                                    <?php    
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>