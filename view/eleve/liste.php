<?php
    require_once("ressources/inc/navbar.php");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="collapse navbar-collapse list-line">

                <div class="col-md-9">
                    <div class="input-group">
                        <input type="search" style="text-align:center" id="tatimSearch" class="search form-control" placeholder="rechercher un élève [par matricule ou par nom]" autofocus>
                        <span class="input-group-addon" style="background: transparent;"><i class="fa fa-search"></i></span>
                    </div>
                </div>

                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#modalAddEleve" title="enregistrer un élève" class="btn btn-primary">
                        <i class="fa fa-plus fa-lg"></i>
                        AJOUTER UN ELEVE
                    </a>
                </div>
            </div>

        </div>
        <div class="col-md-9 gs-content" style="max-height:520px; margin-top:0px">

            <table id="tatimTable" class="table">
                <thead><tr><th style="border:0px"></th></tr></thead>
                <tbody>
                <?php
                    foreach ($eleves as $eleve) {
                        $nom_eleve = strtoupper($eleve->getNom());
                        $nom_eleve .= " ".strtoupper($eleve->getPostnom());
                        $nom_eleve .= " ".strtoupper($eleve->getPrenom());
                        ?>
                    <tr>
                        <td style="border: 0px">
                            <!-- LIST ALL ECHANTILLON -->
                            <li class="list-group-item" style="border:none; border-bottom: 1px solid #5bc0de;">
                                <a href="#"  data-toggle="modal" data-target=".modalDetailEleve<?= $eleve->getId() ?>" title="cliquer pour voir en détail">
                                    <h4 class="list-group-item-header" style="color:#5bc0de">
                                        <?= $nom_eleve ?>
                                    </h4>
                                </a>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="list-group-item-text">Matricule: <strong><?= $eleve->getMatricule() ?></strong></p>
                                        <p class="list-group-item-text">Genre: <strong><?= $eleve->getGenre() ?></strong></p>
                                        <p class="list-group-item-text">Tuteur: <strong><?= $eleve->getNomTuteur() ?></strong></p>

                                    </div>

                                    <div class="col-md-8">
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEditerEleve<?= $eleve->getId() ?>">
                                            <i class="fa fa-edit"></i> Editer
                                        </a>

                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target=".modalDetailEleve<?= $eleve->getId() ?>">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                            <!-- MODAL DETAIL -->
                                            <div class="modal fade modalDetailEleve<?= $eleve->getId() ?>" >
                                                <div class="modal-dialog livi-dialog modal-lg" style="max-width: 800px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" style="background: red; color: #FAFAFA; width: 30px" data-dismiss="modal">&times;</button>
                                                            <span><strong>DETAIL ELEVE</strong></span>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5 class="gs-center gs-color">INFO ELEVE</h5>
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Matricule</th>
                                                                                <td><?= $eleve->getMatricule() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Nom</th>
                                                                                <td><?= strtoupper($eleve->getNom()) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Postnom</th>
                                                                                <td><?= strtoupper($eleve->getPostnom()) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Prenom</th>
                                                                                <td><?= $eleve->getPrenom() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Genre</th>
                                                                                <td><?= $eleve->getGenre() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Lieu de naissance</th>
                                                                                <td><?= $eleve->getLieuNaissance() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Date de naissance</th>
                                                                                <td><?= $eleve->getDateNaissance() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Ecole de Provenance</th>
                                                                                <td><?= $eleve->getEcoleProvenance() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Date Inscription</th>
                                                                                <td><?= $eleve->getDateInscription() ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <h5 class="gs-center gs-color">ETAT DE SANTE</h5>
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <tr class="info">
                                                                                <th>Etat</th>
                                                                                <td><?= $eleve->getEtatSante() ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <h5 class="gs-center gs-color">INFO RESPONSABLE</h5>
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Nom du pere</th>
                                                                                <td><?= strtoupper($eleve->getNomPere()) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Nom de la mere</th>
                                                                                <td><?= strtoupper($eleve->getNomMere()) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Nom du tuteur</th>
                                                                                <td><?= strtoupper($eleve->getNomTuteur()) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Adresse Responsable</th>
                                                                                <td><?= $eleve->getAdresseResponsable() ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Contact Responsable</th>
                                                                                <td><?= $eleve->getContactResponsable() ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPaiement<?= $eleve->getId() ?>">
                                            <i class="fa fa-money"></i> Paiement
                                        </a>

                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalSoin<?= $eleve->getId() ?>">
                                            <i class="fa fa-plus"></i> soin
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </td>
                    </tr>
                    <!-- LES FENETRES MODALS -->

                    <!-- MODAL EDITER  -->
                    <div class="modal fade" id="modalEditerEleve<?= $eleve->getId() ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <span><strong>MODIFICATION ELEVE</strong></span>
                                </div>

                                <form action="index.php?m=nuru-eleve.update" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-6">
                                                    <label>Nom</label>
                                                    <input type="text" name="nom" class="form-control" value="<?= $eleve->getNom() ?>" required="" autofocus />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Postnom</label>
                                                    <input type="text" name="postnom" class="form-control" value="<?= $eleve->getPostnom() ?>" required="" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Prenom</label>
                                                    <input type="text" name="prenom" class="form-control" value="<?= $eleve->getPrenom() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Genre</label>
                                                    <select name="genre" class="form-control">
                                                        <option value="m" <?= ($eleve->getGenre()== 'm') ? 'selected' : '' ?>>M</option>
                                                        <option value="f" <?= ($eleve->getGenre()== 'f') ? 'selected' : '' ?>>F</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Etat de santé</label>
                                                    <input type="text" name="etat_sante" class="form-control" value="<?= $eleve->getEtatSante() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Lieu de naissance</label><br>
                                                    <input type="text" name="lieu_naissance" class="form-control" value="<?= $eleve->getLieuNaissance() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Date de naissance</label>
                                                    <input type="date" name="date_naissance" class="form-control" value="<?= $eleve->getDateNaissance() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Ecole de provenance</label>
                                                    <input type="text" name="ecole_provenance" class="form-control" value="<?= $eleve->getEcoleProvenance() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Nom du pere</label>
                                                    <input type="text" name="nom_pere" class="form-control" value="<?= $eleve->getNomPere() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Nom de la mère</label>
                                                    <input type="text" name="nom_mere" class="form-control" value="<?= $eleve->getNomMere() ?>" required="" />
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label>Nom du tuteur</label>
                                                    <input type="text" name="nom_tuteur" class="form-control" value="<?= $eleve->getNomTuteur() ?>" required="" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Contact du responsable</label>
                                                    <input type="text" name="contact_responsable" class="form-control" value="<?= $eleve->getContactResponsable() ?>" minlength="10" maxlength="10" required="" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Adresse du responsable</label>
                                                    <input type="text" name="adresse_responsable" class="form-control" value="<?= $eleve->getAdresseResponsable() ?>" required="" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="id_eleve" value="<?= $eleve->getId() ?>" />
                                        <button class="btn btn-danger" data-dismiss="modal">annuler</button>
                                        <button class="btn  btn-primary" name="update" type="submit">modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- MODAL PAIEMENT -->
                    <div class="modal fade" id="modalPaiement<?= $eleve->getId() ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <span><strong>PAIEMENT ELEVE</strong></span>
                                </div>

                                <form action="index.php?m=nuru-eleve.paiement" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-12">
                                                    <select name="id_frais" class="form-control">
                                                        <?php foreach ($allFrais as $frais): ?>
                                                            <option value="<?= $frais->getId() ?>"><?= $frais->getDesignation() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Montant à payer</label>
                                                    <input type="number" name="montant" class="form-control" min="0" required="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id_eleve" value="<?= $eleve->getId() ?>" />
                                        <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                                        <button class="btn  btn-primary" name="payer" type="submit">effectuer paiement</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <!-- MODAL SOIN -->
                        <div class="modal fade" id="modalSoin<?= $eleve->getId() ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <span><strong>SOIN ELEVE</strong></span>
                                    </div>

                                    <form action="index.php?m=nuru-soin.add" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group col-md-12">
                                                        <label>Motif</label>
                                                        <textarea name="motif" class="form-control" rows="10" placeholder="decrivez le soin de cet élève."></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id_eleve" value="<?= $eleve->getId() ?>" />
                                            <button class="btn btn-danger sk-btn-annule" data-dismiss="modal">annuler</button>
                                            <button class="btn  btn-primary" name="create" type="submit">enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="form-group" style="margin-top:20px">
                <ul class="list-group" ng-show="fee!=null">
                    <li class="list-group-item">
                        <span class="badge" Style="background-color:#58bcfa;"><?= count($eleves) ?> </span> TOTAL ELEVES
                    </li>
                </ul>
            </div>

            <div class="form-group hidden" style="margin-top:20px">
                <h5 style="text-align: center">Legende</h5>
                <ul class="list-group">
                    <li class="list-group-item" title="si le receptionniste n'a pas encore accuser reception (valider) l'echantillon">
                        <span class="badge" Style="background-color:#D50000;">a une dette </span> rouge
                    </li>
                    <li class="list-group-item" title="la reception de l'echantillon est validée par le receptionniste">
                        <span class="badge" Style="background-color:#58bcfa;">n'a aucune dette</span> bleu
                    </li>
                </ul>
            </div>

            <?php
            if(isset($alertFlash) && !empty($alertFlash)){
                $type = array_keys($alertFlash);
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-<?= $type[0] ?> alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?= $alertFlash[$type[0]] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
</div>

<!-- MODAL AJOUT  -->
<div class="modal fade" id="modalAddEleve">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span><strong>ENREGISTREMENT ELEVE</strong></span>
            </div>

            <form action="index.php?m=nuru-eleve.add" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control"  required="" autofocus />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Postnom</label>
                                <input type="text" name="postnom" class="form-control"  required="" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Prenom</label>
                                <input type="text" name="prenom" class="form-control" required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Genre</label>
                                <select name="genre" class="form-control">
                                    <option value="m">M</option>
                                    <option value="f">F</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Etat de santé</label>
                                <input type="text" name="etat_sante" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Lieu de naissance</label><br>
                                <input type="text" name="lieu_naissance" class="form-control" required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Date de naissance</label>
                                <input type="date" name="date_naissance" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ecole de provenance</label>
                                <input type="text" name="ecole_provenance" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nom du pere</label>
                                <input type="text" name="nom_pere" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nom de la mère</label>
                                <input type="text" name="nom_mere" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nom du tuteur</label>
                                <input type="text" name="nom_tuteur" class="form-control"  required="" />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Contact du responsable</label>
                                <input type="text" name="contact_responsable" class="form-control" minlength="10" maxlength="10" required="" />
                            </div>

                            <div class="form-group col-md-12">
                                <label>Adresse du responsable</label>
                                <input type="text" name="adresse_responsable" class="form-control"  required="" />
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
