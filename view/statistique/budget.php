<?php
    require_once("ressources/inc/navbar.php");

    $dateController = new DateController();
    $moisSysteme = $dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
    $anneeSysteme = $dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));

    $solde = ($total_revenu_mois-$total_depense_mois);
    ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">

    <!-- Main content -->
    <section class="content max-height" style="overflow:hidden404">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            STATISTIQUE DU BUDGET -
                            <?= strtoupper($moisSysteme->getMoisEnLettre()) ?>
                            <?= $anneeSysteme->getAnnee() ?>
                        </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Visualisation</a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="budgetChart" style="height: 350px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-2 col-md-offset-1 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green">
                                        <i class="fa fa-caret-up"></i> 100%
                                    </span>
                                    <h5 class="description-header"><?= $total_revenu_mois ?></h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 col-xs-6" style="background: #FFFF8D">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green">
                                        <i class="fa fa-caret-left"></i>
                                        <?= ($total_revenu_mois != 0) ? substr((($total_paiement_mois*100)/$total_revenu_mois),0,4) : 0 ?>%
                                    </span>
                                    <h5 class="description-header"><?= $total_paiement_mois ?></h5>
                                    <span class="description-text">PAIEMENT ELEVE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 col-xs-6" style="background: #82B1FF">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green">
                                        <i class="fa fa-caret-up"></i> <?= ($total_revenu_mois != 0) ? substr((($total_don_mois*100)/$total_revenu_mois),0,4) : 0 ?>%
                                    </span>
                                    <h5 class="description-header"><?= $total_don_mois ?></h5>
                                    <span class="description-text">DONS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 col-xs-6" style="background: #FF8A80">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green">
                                        <i class="fa fa-caret-down"></i> <?= ($total_revenu_mois != 0) ? substr((($total_depense_mois*100)/$total_revenu_mois), 0,4) : 0 ?>%
                                    </span>
                                    <h5 class="description-header"><?= $total_depense_mois ?></h5>
                                    <span class="description-text">DEPENSES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-green">
                                        <i class="fa fa-caret-down"></i> <?= ($total_revenu_mois != 0) ? substr((($solde*100)/$total_revenu_mois), 0,4) : 0 ?>%
                                    </span>
                                    <h5 class="description-header"><?= $solde ?></h5>
                                    <span class="description-text">SOLDE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    var data = <?= $budget_statistique ?>;
    var date = [];
    var total_montant_don = [];
    var total_montant_paiement = [];
    var total_montant_depense = [];

    for (var i in data) {
        date.push(data[i].jour);
        total_montant_don.push(data[i].total_montant_don);
        total_montant_paiement.push(data[i].total_montant_paiement);
        total_montant_depense.push(data[i].total_montant_depense);
    }

    var lineChartData = {
        labels : date,
        datasets : [
            {
                label: "Paiement elève",
                fillColor : "#FFFDE7",
                strokeColor : "#FFFF8D",
                pointColor : "#FFFF8D",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#FFFF8D",
                data : total_montant_paiement
            },
            {
                label: "Budget don",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "#82B1FF",
                pointColor : "#82B1FF",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#82B1FF",
                data : total_montant_don
            },
            {
                label: "Depense",
                fillColor : "#FFEBEE",
                strokeColor : "#FF8A80",
                pointColor : "#FF8A80",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#FF8A80",
                data : total_montant_depense
            }

        ]

    }

    window.onload = function(){
        var ctx = document.getElementById("budgetChart").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {
            maintainAspectRatio : true, /** joue avec l'affichage de la police (moins important) */
            responsive : true,
            legend: {
                display: true /** affiche la legende [couleur bleu] cas succes et [couleur rouge] cas echec */
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true, /** affiche les lignes verticales sur la graphe */
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : true, /** affiche les lignes horizontales sur la graphe */
                    }
                }]
            }
        });
    }


</script>
