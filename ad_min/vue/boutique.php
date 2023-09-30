<?php
if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            Boutique
        </div>
        <!-- <div class="goldTitre"></div> -->
    </div>
</div>

<?php 
$idProduit = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produit = getProduitById($bdd, $idProduit);
?>
<ul class="nav nav-tabs mt-3">
  <li class="nav-item">
    <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="boutique">Saisie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="gestion_boutique">Gestion</a>
  </li>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '3')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" ><?php echo $produit['nom_produit']; ?></a>
  </li>
  <?php } ?>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '4')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '4' ? ' active' : ''); ?>" aria-current="page" >Photos de <?php echo $produit['nom_produit']; ?></a>
  </li>
  <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/saisie_produit.php');
}else{
if ($_GET['section'] == 2){
    include ('../vue/gestion_boutique.php');
}
if ($_GET['section'] == 3){
  include ('../vue/fiche_produit.php');
}
if ($_GET['section'] == 4){
  include ('../vue/saisie_photos_produit.php');
}

}

?>