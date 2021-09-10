<?php
    require_once("ressources/inc/navbar.php");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style=" background-image: url('ressources/assets/img/maison_nuru.jpg'); background-repeat: round">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="col-md-9 gs-content" style="max-height:520px; margin-top:0px;">


        </div>

        <div class="col-md-3">
            <div class="form-group" style="margin-top:20px">
                <h5 style="text-align: center">MINI STATISTIQUE</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge" Style="background-color:#58bcfa;"><?= $totalEleve ?> </span> TOTAL ELEVES
                    </li>
                    <li class="list-group-item">
                        <span class="badge" Style="background-color:#58bcfa;"><?= $totalDon ?> </span> TOTAL DONS
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>