<?php
  require('../modele/connexion_pdo.php');
  require('../modele/fonctions.php');
  ob_start();
  session_start();
  ?>
<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Google Analytics -->
    <?php
      if (isset($_COOKIE['site_visited'])) {
      ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8Y39FNE19P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag("js", new Date());
      gtag("config", "G-8Y39FNE19P");
    </script>
    <?php
      }
      ?>
    <!-- Fin Google Analytics -->
    <meta name="description" content="L'École du Chat est une association dédiée au sauvetage, à l'adoption et à l'aide pour adopter des chats dans la région de Metz, Moselle. Venez découvrir nos adorables chats et aidez-nous à leur offrir un foyer aimant.">
    <meta name="keywords" content="Adopter un chat, Adopter un chaton, Association, Chats, Adoption, Sauvetage, Metz, Moselle, École du Chat, Ecole du chat">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>École du chat</title>
    <link rel="icon" href="public/assets/images/Logo-principal.jpg" />

    <!-- JQuery - CSS - Bootstrap -->
    <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/assets/css/css.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- FIN JQuery - CSS - Bootstrap -->


    <!-- CROP iMAGE PROFIL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <!-- Fin CROP iMAGE PROFIL -->

    <!-- ReCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lfznh0nAAAAAOk9d9CojhqCh4DEDz_w4U-kBUZP"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcyEx4nAAAAACAO-__6Fo4GJl1hSOUByJFQRcWm"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LePuB4nAAAAANWs-QcPnblx5a1HrSL3X8MLpzFH"></script>
    <script>
      function onSubmit(token) {
        document.getElementById("form-fa").submit();
      }
      function onSubmit(token) {
        document.getElementById("form-ad").submit();
      }
      function onSubmit(token) {
        document.getElementById("inscription").submit();
      }
    </script>
    <!-- Fin ReCaptcha -->

    <!-- facebook share -->
    <?php
      if (isset($_GET['page']) && $_GET['page'] == '5') {
        $data = getArticleById($bdd, $_GET['id']);
        $image = getImageArticleFB($bdd,$_GET['id']);
        if ($image !== false){
          $image_article = $image['fichier'];
        }else{
          $image_article = 'public/assets/images/pexels-anna-shvets-4587959.jpg';
        }
        ?>
    <meta property="og:url" content="<?php echo $data['currentUrl']; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $data['titre_article']; ?>" />
    <meta property="og:description" content="<?php echo $data['article']; ?>" />
    <meta property="og:image" content="<?php echo $image_article; ?>" />
    <?php
      }
      ?>
    <?php
      if (isset($_GET['page']) && $_GET['page'] == '3') {
        $data = getChatFB($bdd, $_GET['id']);
        $image = getFirstImageChat($bdd, $_GET['id']);
        if ($image !== false) {
            $image_chat = $image['fichier'];
        } else {
            $image_chat = 'public/assets/images/pexels-anna-shvets-4587959.jpg';
        }
        ?>
    <meta property="og:url" content="<?php echo $data['currentUrl']; ?>" />
    <meta property="og:type" content="chat" />
    <meta property="og:title" content="<?php echo $data['nom_chat']; ?>" />
    <meta property="og:description" content="<?php echo $data['description']; ?>" />
    <meta property="og:image" content="<?php echo $image_chat; ?>" />
    <?php
      }
      ?>
    <!-- Fin facebook share -->

  </head>
  <body>
    <?php include '../vue/barnav.php'; ?>
    <?php
      if (!isset($_GET['page'])) {
        include('../vue/accueil.php');
      } else {
        if ($_GET['page'] == 2) {
          include ('../vue/chats.php');
        } elseif ($_GET['page'] == 3) {
          include ('../vue/fiche_chat.php');
        } elseif ($_GET['page'] == 4) {
          include ('../vue/articles.php');
        } elseif ($_GET['page'] == 5) {
          include ('../vue/article.php');
        } elseif ($_GET['page'] == 6) {
          include ('../vue/events.php');
        } elseif ($_GET['page'] == 7) {
          include ('../vue/connexion.php');
        } elseif ($_GET['page'] == 8) {
          include ('../vue/inscription.php');
        } elseif ($_GET['page'] == 9) {
          include ('../vue/espace_user.php');
        } elseif ($_GET['page'] == 10) {
          include ('../vue/form_adoption.php');
        } elseif ($_GET['page'] == 11) {
          include ('../vue/dons.php');
        } elseif ($_GET['page'] == 12) {
          include ('../vue/boutique.php');
        } elseif ($_GET['page'] == 13) {
          include ('../vue/fiche_produit.php');
        } elseif ($_GET['page'] == 14) {
          include ('../vue/panier.php');
        } elseif ($_GET['page'] == 15) {
          include ('../vue/conseils_adoption.php');
        } elseif ($_GET['page'] == 16) {
          include ('../vue/conseils_alimentaire.php');
        } elseif ($_GET['page'] == 17) {
          include ('../vue/sterlisation.php');
        } elseif ($_GET['page'] == 18) {
          include ('../vue/chat_stresse.php');
        } elseif ($_GET['page'] == 19) {
          include ('../vue/qui_sommes_nous.php');
        } elseif ($_GET['page'] == 20) {
          include ('../vue/mentions_legales.php');
        } elseif ($_GET['page'] == 21) {
          include ('../vue/tarifs.php');
        } elseif ($_GET['page'] == 22) {
          include ('../vue/form_famille_accueil.php');
        } elseif ($_GET['page'] == 23) {
          include ('../vue/form_adoption_reussi.php');
        } elseif ($_GET['page'] == 24) {
          include ('../vue/mdp_oublie.php');
        } elseif ($_GET['page'] == 25) {
          include ('../vue/inscription_reussi.php');
        } elseif ($_GET['page'] == 26) {
          include ('../vue/on_parle_de_nous.php');
        } elseif ($_GET['page'] == 27) {
          include ('../vue/form_fa_reussi.php');
        } elseif ($_GET['page'] == 28) {
          include ('../vue/mdp_reinstaller.php');
        } elseif ($_GET['page'] == 29) {
          include ('../vue/nous_contacter.php');
        } elseif ($_GET['page'] == 30) {
          include ('../vue/credits.php');
        } elseif ($_GET['page'] == 31) {
          include ('../vue/cookies.php');
        } elseif ($_GET['page'] == 32) {
          include ('../vue/rgpd.php');
        }
        
      }
      ?>
    <?php include '../vue/footer.php'; ?>

    <!-- COOKIES -->
    <?php
      if (!isset($_COOKIE['site_visited']) && !isset($_COOKIE['dismissed'])) {
        echo '<div id="cookie_notice" class="toast-container position-fixed bottom-0 end-0 p-3">
          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <img style="width: 20px; height:auto" src="public/assets/images/smile.png" class="rounded me-2" alt="...">
                <strong class="me-auto">Cookies</strong>
                <button type="button" class="btn-close" id="dismiss" aria-label="Close" data-bs-dismiss="toast"></button>
              </div>
              <div class="toast-body">
                Le respect de vos données personnelles est notre priorité
                En cliquant sur “J\'accepte”, vous acceptez l\'utilisation de cookies et les traceurs servant à mesurer l\'audience et à comprendre votre navigation.
                <div class="mt-2 pt-2 border-top">
                  <button type="button " class="btn btn-primary btn-sm btnCookie" id="accept">J\'accepte</button>
                  <a href="index.php?page=31" type="button" class="btn btn-secondary btn-sm" >En savoir plus</a>
                </div>
              </div>
          </div>
        </div>';
      }
      ?>
    <!-- FIN COOKIES -->

    <!-- VIDEO LOTTIEFILES -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- FIN VIDEO LOTTIEFILES -->

    <!-- js - BOOTSTRAP -->
    <script src="public/assets/js/js.js"></script>
    <script src="public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- FIN js - BOOTSTRAP -->

  </body>
</html>