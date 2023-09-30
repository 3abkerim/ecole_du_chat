<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// var_dump($_SESSION['idPanier']);
// var_dump($cartItems);
$uri = trim($_SERVER['REQUEST_URI'], '/'); 
$url_parts = explode('/', $uri);
$page = $url_parts[0]; 
  
?>
<!-- BARNAV -->
<nav id="navbar" class="navbar navbar-expand-lg testSticky">
  <div class="container-fluid">
    <a class="navbar-brand" href="accueil"><img class="logoNav" src="public/assets/images/Logo-principal.jpg" alt="" /></a>
    <button class="navbar-toggler testBorder" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="testToggle"><img src="public/assets/images/hamburger.png" alt=""></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($page == 'accueil') ? 'active' : '' ?>" aria-current="page" href="accueil">Accueil</a>
        </li>
        <?php $drop_pages_6 = ['chats','fiche_chat','form_adoption'] ?>
        <li class="nav-item">
          <a class="nav-link  <?= (in_array($page, $drop_pages_6)) ? 'active' : '' ?>" href="chats">Nos chats</a>
        </li>
        <li class="nav-item dropdown">
          <?php $drop_pages = ['qui_sommes_nous','tarifs','chat_stresse','conseils_adoption','conseils_alimentaire','sterlisation'] ?>

          <a class="nav-link dropdown-toggle <?= (in_array($page, $drop_pages)) ? 'active' : '' ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false"> S'informer </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="qui_sommes_nous">Qui sommes-nous?</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="tarifs">Frais d'adoption</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="chat_stresse">Conseils chat stressé</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="conseils_adoption">Conseils après adoption</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="conseils_alimentaire">Conseils alimentaires</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="sterlisation">Stérilisation</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <?php $drop_pages_2 = ['articles','events','on_parle_de_nous','article'] ?>

          <a class="nav-link dropdown-toggle <?= (in_array($page, $drop_pages_2)) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Actions </a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a href="articles" class="dropdown-item">Articles</a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li class="nav-item">
              <a href="events" class="dropdown-item">Événements</a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li class="nav-item">
              <a href="on_parle_de_nous" class="dropdown-item">On parle de nous</a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <?php $drop_pages_3 = ['dons','form_famille_accueil'] ?>

          <a class="nav-link dropdown-toggle <?= (in_array($page, $drop_pages_3)) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Nous aider </a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a href="dons" class="dropdown-item">Faire un don</a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li class="nav-item">
              <a href="form_famille_accueil" class="dropdown-item">Devenir une famille d'accueil</a>
            </li>
          </ul>
        </li>

        <?php $drop_pages_5 = ['boutique','fiche_produit'] ?>
        <li class="nav-item">
          <a href="boutique" class="nav-link  <?= (in_array($page, $drop_pages_5)) ? 'active' : '' ?>">Boutique</a>
        </li>
        <?php $drop_pages_4 = ['espace_user','connexion'] ?>
        <li class="nav-item">
          <a href="espace_user" class="nav-link <?= (in_array($page,$drop_pages_4)) ? 'active' : '' ?>">Mon compte</a>
        </li>
      </ul>
      <a target="_blank" href="https://www.facebook.com/ecoleduchatmetz"><img class="socialNav" src="public/assets/images/facebook.png" alt="" /></a>
      <a target="_blank" href="https://www.instagram.com/ecoleduchatmetz/"><img class="socialNav" src="public/assets/images/instagram.png" alt="" /></a>
      <!-- <a href="index.php?page=14">
        <div class="notification-container">
          <img class="socialNavPanier" src="assets/images/<?php //echo (getCartItemCount($cartItems) === 0) ? 'pet-bowl-empty.png' : 'pet-bowl.png'; ?>" alt="" />
          <span class="notif span <?php //echo (getCartItemCount($cartItems) === 0) ? 'notifHidden' : ''; ?>"><?php //echo getCartItemCount($cartItems); ?></span>
        </div>
      </a> -->
    </div>
  </div>
</nav>
<!-- END BARNAV -->
