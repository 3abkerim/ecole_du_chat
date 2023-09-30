<!--HEADER-->
<!--<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <img class="logo" src="../public/assets/images/logo_noire.png" alt="">
        </div>
    </div>
</div>-->

<!--NAV-->
<?php
$currentPage = basename($_SERVER['PHP_SELF']);

?>
<nav class="navbar navbar-expand-lg navbar-dark navbarBg">
        <div class="container">
            <img class="logo" onclick="window.location='index.php'" src="assets/images/logo_blanc.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto ms-2 my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php') { echo 'active'; } ?>" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=2') { echo 'active'; } ?>" href="index.php?page=2">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=3') { echo 'active'; } ?>" href="index.php?page=3">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=4') { echo 'active'; } ?>" href="index.php?page=4">Vendre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=5') { echo 'active'; } ?>" href="index.php?page=5">Agence</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=6') { echo 'active'; } ?>" href="index.php?page=6">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage == 'index.php?page=7') { echo 'active'; } ?>" href="index.php?page=7">S'identifier</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

