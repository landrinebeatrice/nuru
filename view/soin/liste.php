<?php 
    require_once("ressources/inc/navbar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">TOUS LES SOINS DU <?= $dateSystemeFormatNormal ?></h3>

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
                            <th>MATRICULE</th>
                            <th>ELEVE</th>
                            <th>MOTIF</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            $total_soin = 0;
                            foreach ($soins as $soin):
                                if($soin->getDateSoin() != $dateSystemeFormatSql){ continue; }
                                $eleve = $soin->getEleve();
                                $nom_eleve = strtoupper($eleve->getNom(). " ".$eleve->getPostnom()." ".$eleve->getPrenom());
                                $total_soin++;
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $eleve->getMatricule() ?></td>
                                    <td><?= $nom_eleve ?></td>
                                    <td><?= $soin->getMotif() ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerSoin<?= $soin->getId() ?>" class="btn btn-primary text-center">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- MODAL EDITER -->
                                        <div class="modal fade" id="modalEditerSoin<?= $soin->getId() ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <span><strong>MODIFICATION SOIN</strong></span>
                                                    </div>

                                                    <form action="#" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Motif</label>
                                                                        <textarea rows="10" name="motif" class="form-control">
                                                                            <?= $soin->getMotif() ?>
                                                                        </textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_soin" value="<?= $soin->getId() ?>" />
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
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
