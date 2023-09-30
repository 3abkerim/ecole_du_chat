<?php
// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';

if (!isset($_SESSION['idUser'])){
  header('Location:connexion');
  exit();
}
$idUser = $_SESSION['idUser'];
$user = getUser($bdd,$idUser);
$departements = getDep($bdd);
$villes = getVilles($bdd,$user['id_departement']);
$chats_ac = getChatsAccueillis($bdd,$idUser);
$chats_ad = getChatsAdoptes($bdd,$idUser);

?>
<div class="container content">
  <div class="row mt-5">
    <div class="col-lg-2 text-center">
      <?php if ($user['fichier'] == NULL ){ ?>
      <img class="imgProfil img-fluid" src="public/assets/images/user.png" alt="" />
      <?php }else{ ?>
      <img class="imgProfil2 img-fluid rounded-circle" src="<?php echo $user['fichier']; ?>" alt="" />
      <?php } ?>
    </div>
    <div class="col-lg-3 d-flex align-items-center justify-content-center">
      <div class="row">
        <div class="col-12 nomUser"><?php echo $user['prenom']; echo ' '; echo $user['nom'] ?></div>
        <div class="col-12 deconnexion_center">
          <a href="traitement_deconnexion" class="d-flex align-items-center deconnexion">
            <div class="dec2">Déconnexion</div>
            <img class="logout img-fluid" src="public/assets/images/logout.png" alt="" />
          </a>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <ul class="nav nav-tabs navUser mt-3">
    <li class="nav-item">
      <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="espace_user">Mes infos personnelles</a>
    </li>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '5')){ ?>
    <li class="nav-item">
        <a class="nav-link active">Modifier photo de profil</a>
    </li>
    <?php } ?>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '4')){ ?>
    <li class="nav-item">
        <a class="nav-link active">Modifier mot de passe </a>
    </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" href="chats_adoptes">Chats adoptés</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" href="chats_accueillis">Chats accueillis</a>
    </li>

  </ul>
</div>

<?php
if (!isset($_GET['section'])){
    include('../vue/info_user.php');
}else{
    if ($_GET['section'] == 2){
        include ('../vue/chats_adoptes.php');
    }
    elseif ($_GET['section'] == 3){
        include ('../vue/chats_accueillis.php');
    }
    elseif ($_GET['section'] == 4){
      include ('../vue/modifieMdp.php');
    }
    elseif ($_GET['section'] == 5){
      include ('../vue/modifiePhotoDeProfil.php');
    }
}

?>
