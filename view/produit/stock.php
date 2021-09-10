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
            <div class="col-md-12 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">SITUATION STOCK PRODUIT</h3>

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
                            <th>QTE ENTREE</th>
                            <th>QTE SORTIE</th>
                            <th>STOCK FINAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($produits as $produit):
                                $qte_entree = $produitController->getTotalQteEntree($produit);
                                $qte_sortie = $produitController->getTotalQteSortie($produit);
                                $stock_final = $produitController->getStockFinal($produit);
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ucfirst($produit->getDesignation()) ?></td>
                                    <td><?= $qte_entree ?></td>
                                    <td><?= $qte_sortie ?></td>
                                    <td><?= $stock_final ?></td>
                                    <td>
                                        <a href="#" title="Cliquer pour modifier" data-toggle="modal" data-target="#modalEditerStock<?= $produit->getId() ?>" class="hidden btn btn-primary text-center">
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

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
