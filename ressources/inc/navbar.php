<?php
    //interdir l'acces au non utilisateur
    AuthController::is_connected();

    $userConnected = AuthController::getSession("auth");

    //refresh methode
    $refresh = (isset($_GET['m'])) ? $_GET['m'] : 'refresh';

    /* SYSTEME DATE */
    $dateController = new DateController();

    $dateSysteme = AuthController::getSession("dateSysteme");
    $moisSysteme = AuthController::getSession("moisSysteme");
    $anneeSysteme = AuthController::getSession("anneeSysteme");

    $_mois = MoisModel::getMois("mois_en_chiffre", $moisSysteme);
    $_annee = AnneeModel::getAnnee("annee", $anneeSysteme);

    $dataDateSysteme = $dateController->selectAllDate($_mois, $_annee);
    $dataMoisSysteme = $dateController->getAllMois();
    $dataAnneeSysteme = $dateController->getAllAnnee();
?>
<body class="hold-transition skin-blue sidebar-mini" style="overflow: hidden">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo" style="background-color: #222222">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>NURU</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>NURU</b>-M</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="background-color: #222222">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages and Notification-->

                    <li><a href="index.php?m=<?= $refresh ?>"><i class="fa fa-refresh fa-2px"></i> Actualiser</a></li>

                    <li style="margin-top: 7px">
                        <form action="index.php?m=nuru-date.configuration" id="dateSystemForm" method="POST">
                            <select class="form-control" name="dateSystemSelected" id="dateSystemSelected" style="border:3px solid #37474F;">
                                <?php
                                foreach($dataDateSysteme as $date):
                                    $_date = $date->getJour()->format("d-m-Y");
                                    $_day = $date->getJour()->format("d");
                                    ?>
                                    <option value="<?= $_date; ?>" <?= ($_date == $dateSysteme) ? 'selected' : '' ?>><?= $_day ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="current_url" value="index.php?m=<?= $refresh ?>">
                        </form>
                    </li>

                    <li style="margin-top: 7px">
                        <form action="index.php?m=nuru-date.configuration" id="moisSystemForm" method="POST">
                            <select class="form-control" name="moisSystemSelected" id="moisSystemSelected" style="border:3px solid #37474F;">
                                <?php foreach($dataMoisSysteme as $mois): ?>
                                    <option value="<?= $mois->getMoisEnChiffre() ?>" <?= ($mois->getMoisEnChiffre() == $moisSysteme) ? 'selected' : '' ?>><?= $mois->getMoisEnLettre() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="current_url" value="index.php?m=<?= $refresh ?>">
                        </form>
                    </li>

                    <li style="margin-top: 7px">
                        <form action="index.php?m=nuru-date.configuration" id="anneeSystemForm" method="POST">
                            <select class="form-control" name="anneeSystemSelected" id="anneeSystemSelected" style="border:3px solid #37474F;">
                                <?php foreach($dataAnneeSysteme as $annee): ?>
                                    <option value="<?= $annee->getAnnee() ?>" <?= ($annee->getAnnee() == $anneeSysteme) ? 'selected' : '' ?>><?= $annee->getAnnee() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="current_url" value="index.php?m=<?= $refresh ?>">
                        </form>
                    </li>

                    <!-- utilisateur account-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="./ressources/assets/img/avatar.jpg" class="user-image" alt="img">
                            <span class="hidden-xs"><?= $userConnected->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="./ressources/assets/img/avatar.jpg" class="img-circle" alt="img">

                                <p>
                                    <?= ucfirst($userConnected->prenom)." ".ucfirst($userConnected->nom) ?> - <?= $userConnected->role ?>
                                    <small>NURU MANAGEMENT</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">

                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php?m=tm-user.account" class="btn btn-default btn-flat">Mon compte</a>
                                </div>
                                <div class="pull-right">
                                    <a href="index.php?m=nuru-utilisateur.logout" class="btn btn-default btn-flat">Deconnexion</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>

    <?php require_once("ressources/inc/sidebar.php"); ?>