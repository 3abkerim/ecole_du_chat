<?php
   if (!isset($_SESSION['idUserAdmin'])){
     header('Location:connexion');
     exit();
   }
   ?>
<div class="row">
   <div class="col-12">
      <div class="titreGestion">
         Articles
      </div>
      <!-- <div class="goldTitre"></div> -->
   </div>
</div>
<?php 
   $idArticle = isset($_GET['id']) ? intval($_GET['id']) : 0;
   // $chat = getChatById($bdd, $idChat);
   ?>
<ul class="nav nav-tabs navbiens mt-3">
   <li class="nav-item">
      <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="articles">Saisie</a>
   </li>
   <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="gestion_articles">Gestion</a>
   </li>
   <?php if (isset($_GET['section']) && ($_GET['section'] === '3')){ ?>
   <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" href="fiche_article">Détails article <?php echo $idArticle; ?></a>
   </li>
   <?php } ?>
   <?php if (isset($_GET['section']) && ($_GET['section'] === '4')){ ?>
   <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '4' ? ' active' : ''); ?>" aria-current="page" href="photos_article">Photos d'article  <?php echo $idArticle; ?></a>
   </li>
   <?php } ?>
</ul>
<?php
   if (!isset($_GET['section'])){
       include('../vue/saisie_article.php');
   }else{
   if ($_GET['section'] == 2){
       include ('../vue/gestion_articles.php');
   }
   if ($_GET['section'] == 3){
     include ('../vue/fiche_article.php');
   }
   if ($_GET['section'] == 4){
     include ('../vue/saisie_photos_article.php');
   }
   
   }
   
   ?>