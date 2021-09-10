<?php
    require_once("ressources/inc/navbar.php");

    $dateController = new DateController();
    $dateSysteme = AuthController::getSession("dateSysteme");
    $moisSysteme = $dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
    $anneeSysteme = $dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));

    $filtre_type = strtoupper($moisSysteme->getMoisEnLettre())." ".$anneeSysteme->getAnnee();
    if($filtre == "day"){ $filtre_type = "du ".$dateSysteme; }
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
                            STATISTIQUE STOCK - <?= $filtre_type ?>
                        </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="index.php?m=nuru-statistique.stock.day">Statistique journalier</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?m=nuru-statistique.stock.month">Statistique mensuel</a></li>
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
                                    <canvas id="stockChart" style="height: 350px;"></canvas>
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
                            <!-- /.col -->
                            <div class="col-sm-4 col-xs-6" style="background: #82B1FF">
                                <div class="description-block border-right">
                                    <span class="description-text">STOCK ENTREE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-xs-6" style="background: #FF8A80">
                                <div class="description-block border-right">
                                    <span class="description-text">STOCK SORTIE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                            <div class="col-sm-4 col-xs-6" style="background: #FFFF8D">
                                <div class="description-block border-right">
                                    <span class="description-text">STOCK FINAL</span>
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
    var data = <?= $stock_statistique ?>;
    var produit = [];
    var qte_entree = [];
    var qte_sortie = [];
    var qte_finale = [];

    for (var i in data) {
        produit.push(data[i].designation);
        var qe = data[i].qte_entree;
        var qs = data[i].qte_sortie;

        //ajout à la pile
        qte_entree.push(qe);
        qte_sortie.push(qs);
        qte_finale.push((parseInt(qe)-parseInt(qs)));
    }

    var lineChartData = {
        labels : produit,
        datasets : [
            {
                label: "STOCK ENTREE",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "#82B1FF",
                pointColor : "#82B1FF",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#82B1FF",
                data : qte_entree
            },
            {
                label: "STOCK SORTIE",
                fillColor : "#FFEBEE",
                strokeColor : "#FF8A80",
                pointColor : "#FF8A80",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#FF8A80",
                data : qte_sortie
            },
            {
                label: "STOCK FINAL",
                fillColor : "#FFFDE7",
                strokeColor : "#FFFF8D",
                pointColor : "#FFFF8D",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "#FFFF8D",
                data : qte_finale
            }
        ]
    }

    window.onload = function(){
        var ctx = document.getElementById("stockChart").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive : true
        });
    }


</script>
