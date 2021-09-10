<?php 
    require_once("ressources/inc/navbar.php");

    $bonController = new BonsortieController();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">TOUS LES BONS SORTIES DU <?= $dateSystemeFormatNormal ?></h3>

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
                            <th>DESCRIPTION</th>
                            <th>ENREGISTRER PAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            $montant_total = 0;
                            foreach ($bons as $bon):
                                if($bon->getDateBon() != $dateSystemeFormatSql){ continue; }
                                $utilisateur = $bon->getUtilisateur();
                                $allSortieBon = $bonController->getAllSortie($bon);
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ucfirst($bon->getDescription()) ?></td>
                                    <td><?= $utilisateur->getUsername() ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerBon<?= $bon->getId() ?>" class="btn btn-primary text-center">
                                            <i class="fa fa-edit"></i> editer
                                        </a>

                                        <!-- MODAL EDITER -->
                                        <div class="modal fade" id="modalEditerBon<?= $bon->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>MODIFICATION BON SORTIE</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Description</label>
                                                                        <textarea rows="10" name="description" class="form-control">
                                                                            <?= $bon->getDescription() ?>
                                                                        </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_bon" value="<?= $bon->getId() ?>" />
                                                            <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                                                            <button class="btn  btn-primary" name="update" type="submit">enregistrer les modifications</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" title="Cliquer pour voir les details" data-toggle="modal" data-target="#modalDetailBon<?= $bon->getId() ?>" class="btn btn-warning text-center">
                                            <i class="fa fa-eye"></i> detail
                                        </a>

                                        <div class="modal fade" id="modalDetailBon<?= $bon->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>DETAIL DES SORTIES DU BON</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                        <tr class="lola-background">
                                                                            <th>#</th>
                                                                            <th>PRODUIT</th>
                                                                            <th>QTE ENTREE</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $i = 1;
                                                                        foreach ($allSortieBon as $sortie):
                                                                            $produit = $sortie->getProduit();
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $i++ ?></td>
                                                                                <td><?= ucfirst($produit->getDesignation()) ?></td>
                                                                                <td><?= $sortie->getQteSortie(); ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>

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
            <div class="col-md-3">
                <a href="#" style="width: 100%" title="Cliquer pour enregistrer un bon" class="btn btn-primary text-center" data-toggle="modal" data-target="#modalAddBon">
                    <i class="fa fa-plus"></i> nouveau bon de sortie
                </a> <br><br>

                <div class="info-box bg-aqua hidden">
                    <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total </span>
                        <h3><?= $montant_total ?> </h3>
                    </div>
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


<!-- MODAL AJOUT  -->
<div class="modal fade" id="modalAddBon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span><strong>ENREGISTREMENT BON</strong></span>
            </div>

            <form action="index.php?m=nuru-bonsortie.add" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="description" rows="6" class="form-control" placeholder="decrivez le motif du bon."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                    <button class="btn  btn-primary" name="create" type="submit">enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>