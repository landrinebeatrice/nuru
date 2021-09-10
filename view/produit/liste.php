<?php 
    require_once("ressources/inc/navbar.php");

    $produitController = new ProduitController();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">TOUTES LES PRODUITS</h3>

                        <?php
                        if(isset($alertFlash) && !empty($alertFlash)){
                            $type = array_keys($alertFlash);
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-<?= $type[0] ?> alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?= $alertFlash[$type[0]] ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->

                    <!-- content depenses -->
                    <table id="studentTable" class="table table-bordered table-striped">
                        <thead>
                        <tr class="info">
                            <th>#</th>
                            <th>DESIGNATION</th>
                            <th>CATEGORIE (type)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($produits as $produit):
                                $categorie = $produit->getCategorie();
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ucfirst($produit->getDesignation()) ?></td>
                                    <td><?= ucfirst($categorie->getDesignation()) ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerProduit<?= $produit->getId() ?>" class="btn btn-primary text-center">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- MODAL EDITER -->
                                        <div class="modal fade" id="modalEditerProduit<?= $produit->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>MODIFICATION PRODUIT</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Designation</label>
                                                                        <input type="text" name="designation" class="form-control" value="<?= $produit->getDesignation() ?>" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <label>Categorie</label>
                                                                        <select class="form-control" name="id_categorie">
                                                                            <?php foreach ($categories as $_categorie): ?>
                                                                                <option value="<?= $_categorie->getId() ?>" <?= ($_categorie->getId()==$categorie->getId()) ? 'selected' : '' ?>><?= ucfirst($_categorie->getDesignation()) ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_produit" value="<?= $produit->getId() ?>" />
                                                            <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                                                            <button class="btn  btn-primary" name="update" type="submit">enregistrer les modifications</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->

            <!-- right column -->
            <div class="col-md-4">

                <div class="box box-info">
                    <div class="box-header with-border gs-info">
                        <h3 class="box-title text-center">AJOUTER UN PRODUIT</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="#" method="POST">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="designation" placeholder="Designation" autofocus required="">
                            </div>

                            <div class="form-group col-md-12">
                                <select class="form-control" name="id_categorie">
                                    <?php foreach ($categories as $_categorie): ?>
                                        <option value="<?= $_categorie->getId() ?>"><?= ucfirst($_categorie->getDesignation()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" style="width: 100%" name="create" class="btn btn-primary pull-right">enregistrer</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
