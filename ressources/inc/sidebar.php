<?php
    $userConnected = AuthController::getSession();

    $module = 'home';
    $action = null;
    if(isset($_GET["m"]) && !empty($_GET["m"])){
        /**
         * @example url: index.php?m=nuru-statistique.stock
         * $getUrl[0] : nuru
         * $getUrl[1] : statistique.stock
         */
        $getUrl = explode("-", $_GET["m"]);
        if(isset($getUrl[1])){
            /**
             * @example : statistique.stock
             * $getUrl[0] : statistique
             * $getUrl[1] : stock
             */
            $getUrl = explode(".", $getUrl[1]);
            $module = $getUrl[0];
            if(isset($getUrl[1])){
                $action = $getUrl[1];
            }
        }
    }
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="position: fixed">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="./ressources/assets/img/avatar.jpg" class="img-circle" alt="img">
        </div>
        <div class="pull-left info">
          <p><?= $userConnected->username ?></p>
        </div>
      </div>

        <ul class="sidebar-menu" data-widget="tree">
		    <!-- <li class="header">BLOG</li> -->
            <li class="header"><i class="fa fa-dashboard"></i> FONCTIONNALITES</li>
            <li class="<?= ($module == 'home') ? 'active' : '' ?>">
                <a href="index.php" style="color:#5bc0de"><i class="fa fa-home"></i>Accueil</a>
            </li>

            <li class="<?= ($module == 'eleve') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-eleve.liste" style="color:#5bc0de"><i class="fa fa-group"></i>Eleves</a>
            </li>

            <li class="treeview <?= (($module == 'frais') || ($module == 'paiement')) ? 'active' : '' ?>">
                <a href="#" style="color:#5bc0de">
                    <i class="fa fa-book"></i><span>Scolarité</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= ($module == 'frais') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-frais.liste"><i class="fa fa-circle-o"></i>Frais scolaire</a>
                    </li>
                    <li class="<?= ($module == 'paiement') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-paiement.liste"><i class="fa fa-circle-o"></i>Paiement</a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?= (($module == 'produit') || ($module == 'categorie')) ? 'active' : '' ?>">
                <a href="#" style="color:#5bc0de">
                    <i class="fa fa-book"></i><span>Produit</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= ($action == 'liste') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-produit.liste"><i class="fa fa-circle-o"></i> Liste</a>
                    </li>
                    <li class="<?= ($action == 'stock') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-produit.stock"><i class="fa fa-circle-o"></i> Situation stock</a>
                    </li>
                    <li class="<?= ($module == 'categorie') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-categorie.liste"><i class="fa fa-circle-o"></i> Categorie</a>
                    </li>
                </ul>
            </li>

            <li class="<?= ($module == 'don') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-don.liste" style="color:#5bc0de"><i class="fa fa-database"></i>Don</a>
            </li>

            <li class="<?= ($module == 'depense') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-depense.liste" style="color:#5bc0de"><i class="fa fa-book "></i>Depenses</a>
            </li>

            <li class="<?= ($module == 'bonsortie') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-bonsortie.liste" style="color:#5bc0de"><i class="fa fa-book "></i>Bon de sortie</a>
            </li>

            <li class="<?= ($module == 'soin') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-soin.liste" style="color:#5bc0de"><i class="fa fa-book"></i> Soin</a>
            </li>

            <li class="treeview <?= ($module == 'statistique') ? 'active' : '' ?>">
                <a href="#" style="color:#5bc0de">
                    <i class="fa fa-pie-chart"></i><span>Statistique</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= ($action == 'stock') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-statistique.stock"><i class="fa fa-circle-o"></i> Stock</a>
                    </li>
                    <li class="<?= ($action == 'budget') ? 'active' : '' ?>">
                        <a href="index.php?m=nuru-statistique.budget"><i class="fa fa-circle-o"></i> Budget</a>
                    </li>
                </ul>
            </li>

            <li class="<?= ($module == 'utilisateur') ? 'active' : '' ?>">
                <a href="index.php?m=nuru-utilisateur.liste" style="color:#5bc0de"><i class="fa fa-gears"></i> Utilisateur</a>
            </li>

            <li>
                <a href="index.php?m=nuru-utilisateur.logout" style="color:#D32F2F"><i class="fa fa-sign-out"></i> Deconnexion</a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>