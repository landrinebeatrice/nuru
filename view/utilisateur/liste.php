<?php 
    require_once("ressources/inc/navbar.php"); 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 gs-content" style="max-height: 550px">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">CONFIGURATION UTILISATEURS DU SYSTEME</h3>

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
                    <!-- /.box-header -->
                    <table id="studentTable" class="table table-bordered table-striped">
                        <thead>
                        <tr class="info">
                            <th>NOM</th>
                            <th>CONTACT</th>
                            <th>EMAIL</th>
                            <th>NOM D'UTILISATEUR</th>
                            <th>ROLE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($utilisateurs as $utilisateur):
                            $nom_utilisateur = strtoupper($utilisateur->getNom()." ".$utilisateur->getPostnom()." ".$utilisateur->getPrenom());
                            ?>
                            <tr>
                                <td><?= $nom_utilisateur ?></td>
                                <td><?= $utilisateur->getContact() ?></td>
                                <td><?= $utilisateur->getEmail() ?></td>
                                <td><?= $utilisateur->getUsername() ?></td>
                                <td><?= $utilisateur->getRole() ?></td>

                                <td>
                                    <a href="#" title="Cliquer pour modifier" class="btn btn-primary text-center">
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
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border gs-info">
                        <h3 class="box-title">ENREGISTREMENT UTILISATEUR</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="#" method="POST">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="nom" placeholder="Nom" autofocus required="">

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="postnom" placeholder="Postnom" required="">

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="prenom" placeholder="Prenom" required="">

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="contact" placeholder="Contact" minlength="10" maxlength="10" required="">

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required="">

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required="">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-md-3">Rôle</label>
                                <div class="input-group col-md-9">
                                    <select class="form-control" name="role">
                                        <option value="receptionniste">----select----</option>
                                        <option value="receptionniste">Receptionniste</option>
                                        <option value="service_social">Service social</option>
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                </div>
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

                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
