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
            <div class="col-md-9 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">TOUS LES PAIEMENT DU <?= $dateSystemeFormatNormal ?></h3>

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
                            <th>MATRICULE</th>
                            <th>ELEVE</th>
                            <th>MONTANT</th>
                            <th>MOTIF</th>
                            <th>EFFECTUE PAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            $montant_total = 0;
                            foreach ($paiements as $paiement):
                                if($paiement->getDatePaiement() != $dateSystemeFormatSql){ continue; }
                                $eleve = $paiement->getEleve();
                                $utilisateur = $paiement->getUtilisateur();
                                $frais = $paiement->getFrais();

                                $nom_eleve = strtoupper($eleve->getNom(). " ".$eleve->getPostnom()." ".$eleve->getPrenom());
                                $motif = ucfirst($frais->getDesignation());
                                $montant = $paiement->getMontant();

                                $montant_total += $montant;
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $eleve->getMatricule() ?></td>
                                    <td><?= $nom_eleve ?></td>
                                    <td><?= $montant ?></td>
                                    <td><?= $motif ?></td>
                                    <td><?= $utilisateur->getUsername() ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" class="btn btn-primary text-center hidden">
                                            <i class="fa fa-edit"></i>
                                        </a>
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
                <!-- Horizontal Form -->
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
