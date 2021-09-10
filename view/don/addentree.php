<?php
    require_once("ressources/inc/navbar.php");
    //$_SESSION["detailDon"] = []; //la session qui contiendra les produits ajouté au don
    $utilisateur = $don->getUtilisateur();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 max-height">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ENREGISTREMENT DES DETAILS DU DON</h3>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xs-12 personal-info">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="lola-background">
                                        <th>NOM BIENFAITEUR</th>
                                        <th>COUT</th>
                                        <th>ENREGISTRER PAR</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= ucfirst($don->getNomBienfaiteur()) ?></td>
                                            <td><?= $don->getCout() ?></td>
                                            <td><?= $utilisateur->getUsername() ?></td>
                                            <td><?= $don->getDateDon() ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">AJOUT DETAIT</h4>
                            </div>

                            <div class="panel-body">
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Produit</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="id_produit">
                                                <?php foreach ($produits as $produit): ?>
                                                    <option value="<?= $produit->getId() ?>"><?= ucfirst($produit->getDesignation()) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> <br>
                                        <br>

                                        <label class="col-lg-3 control-label">Quantité entree</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="number" name="qte_entree" value="0" min="0" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-7">
                                            <button style="width: 100%" type="submit" name="addProduitDon" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> ajouter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-6 col-xs-12 personal-info">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">VISUALISATION DETAIL</h4>
                            </div>
                            <div class="panel-body">
                                <?php if(isset($_SESSION["detailDon"]) && !empty($_SESSION["detailDon"])): ?>
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
                                                $dataIdProduitSession = array_keys($_SESSION["detailDon"]);
                                                foreach ($produits as $prod):
                                                    //on exclu tous les produits qui ne sont pas ajouté dans la session
                                                    if(!in_array($prod->getId(), $dataIdProduitSession)){ continue; }
                                                    $qte_entree = $_SESSION["detailDon"][$prod->getId()];
                                            ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= ucfirst($prod->getDesignation()) ?></td>
                                                        <td><?= $qte_entree ?></td>
                                                    </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <form action="index.php?m=nuru-don.addDetail" method="POST">
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <input type="hidden" name="id_don" value="<?= $don->getId() ?>">
                                                <input type="submit" class="btn btn-danger" name="annulerDetail" value="annuler">
                                                <input type="submit" name="createDetail" class="btn btn-primary" value="enregistrer ces details">
                                            </div>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <p>Aucun produit ajouter au detail de ce don.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>

        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>