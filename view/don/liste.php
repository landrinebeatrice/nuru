<?php 
    require_once("ressources/inc/navbar.php");

    $donController = new DonController();
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
                        <h3 class="box-title">TOUS LES DONS DU <?= $dateSystemeFormatNormal ?></h3>

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
                            <th>NOM BIENFAITEUR</th>
                            <th>COUT</th>
                            <th>ENREGISTRER PAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            $montant_total = 0;
                            foreach ($dons as $don):
                                if($don->getDateDon() != $dateSystemeFormatSql){ continue; }
                                $allEntreeDon = $donController->getAllEntree($don);
                                $utilisateur = $don->getUtilisateur();
                                $montant_total += $don->getCout();
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ucfirst($don->getNomBienfaiteur()) ?></td>
                                    <td><?= $don->getCout() ?></td>
                                    <td><?= $utilisateur->getUsername() ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerDon<?= $don->getId() ?>" class="btn btn-primary text-center">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- MODAL EDITER -->
                                        <div class="modal fade" id="modalEditerDon<?= $don->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>MODIFICATION DON</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Nom Bienfaiteur</label>
                                                                        <input name="nom_bienfaiteur" class="form-control" value="<?= $don->getNomBienfaiteur() ?>" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <label>Cout</label>
                                                                        <input type="number" name="cout" class="form-control" value="<?= $don->getCout() ?>" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_don" value="<?= $don->getId() ?>" />
                                                            <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                                                            <button class="btn  btn-primary" name="update" type="submit">enregistrer les modifications</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" title="Cliquer pour voir les details" data-toggle="modal" data-target="#modalDetailDon<?= $don->getId() ?>" class="btn btn-warning text-center">
                                            <i class="fa fa-eye"></i> detail
                                        </a>

                                        <div class="modal fade" id="modalDetailDon<?= $don->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>DETAIL DES ENTREES DU DON</strong></span>
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
                                                                        foreach ($allEntreeDon as $entree):
                                                                            $produit = $entree->getProduit();
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $i++ ?></td>
                                                                                <td><?= ucfirst($produit->getDesignation()) ?></td>
                                                                                <td><?= $entree->getQteEntree(); ?></td>
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
                <a href="#" style="width: 100%" title="Cliquer pour enregistrer un don" class="btn btn-primary text-center" data-toggle="modal" data-target="#modalAddDon">
                    <i class="fa fa-plus"></i> enregistrer un don
                </a> <br><br>

                <div class="info-box bg-aqua">
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
<div class="modal fade" id="modalAddDon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span><strong>ENREGISTREMENT DON</strong></span>
            </div>

            <form action="index.php?m=nuru-don.add" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label>Nom bienfaiteur</label>
                                <input type="text" name="nom_bienfaiteur" class="form-control"  required="" autofocus />
                            </div>

                            <div class="form-group col-md-12">
                                <label>Cout</label>
                                <input type="number" name="cout" class="form-control" min="0" required="" />
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