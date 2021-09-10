<?php 
    require_once("ressources/inc/navbar.php");
    $userConnected = AuthController::getSession();
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
                        <h3 class="box-title">TOUS LES FRAIS</h3>

                        <?php
                        if(isset($alertFlash) && !empty($alertFlash)){
                            $type = array_keys($alertFlash);
                            ?>
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-2">
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
                            <th>MONTANT</th>
                            <th>DEVISE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($allFrais as $frais):
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $frais->getDesignation() ?></td>
                                    <td><?= $frais->getMontant() ?></td>
                                    <td><?= $frais->getDevise() ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerFrais<?= $frais->getId() ?>" class="btn btn-primary text-center">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- MODAL EDITER -->
                                        <div class="modal fade" id="modalEditerFrais<?= $frais->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>MODIFIER LE FRAIS</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Designation</label>
                                                                        <input type="text" name="designation" class="form-control" value="<?= $frais->getDesignation() ?>" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <label>Montant</label>
                                                                        <input type="number" name="montant" class="form-control" value="<?= $frais->getMontant() ?>" required="">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_frais" value="<?= $frais->getId() ?>" />
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
                        <h3 class="box-title text-center">AJOUTER UN FRAIS</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="#" method="POST">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="designation" placeholder="Designation" autofocus required="">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="number" class="form-control" name="montant" placeholder="Montant" min="0" required="">
                            </div>
                            <div class="form-group col-md-12">
                                <select class="form-control" name="devise">
                                    <option value="fc">**** selectionner une devise ****</option>
                                    <option value="fc">FC</option>
                                    <option value="usd">USD</option>
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
