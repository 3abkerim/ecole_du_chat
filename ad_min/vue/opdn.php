<?php
if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            On parle de nous
        </div>
        <!-- <div class="goldTitre"></div> -->
    </div>
</div>

<?php 
$idOPDN = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<ul class="nav nav-tabs navbiens mt-3">
  <li class="nav-item">
    <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="opdn">Saisie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="gestion_opdn">Gestion</a>
  </li>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '3')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page">Détails OPDN <?php echo $idOPDN; ?></a>
  </li>
  <?php } ?>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '4')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '4' ? ' active' : ''); ?>" aria-current="page" >Photo OPDN  <?php echo $idOPDN; ?></a>
  </li>
  <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/saisie_opdn.php');
}else{
if ($_GET['section'] == 2){
    include ('../vue/gestion_opdn.php');
}
if ($_GET['section'] == 3){
  include ('../vue/fiche_opdn.php');
}
if ($_GET['section'] == 4){
  include ('../vue/saisie_photo_opdn.php');
}

}

?>