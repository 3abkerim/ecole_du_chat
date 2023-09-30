<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$idUser = $_SESSION['idUserAdmin'];
$user = getUserById($bdd,$idUser);

if (!isset($_SESSION['idUserAdmin'])){
    header('Location:connexion');
    exit();
  }
if ($user['role']!=='Superadmin'){
    header('Location:tableau_de_bord');
}

$idUser2 = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_2 = getUserById($bdd,$idUser2);
?>

<div class="container navTest">
    <div class="row ">
        <div class="col-12">
            <div class="titreGestion mt-3">
                Utilisateurs
            </div>
            <!-- <div class="goldTitre"></div> -->
        </div>
    </div>
</div>

<ul class="nav nav-tabs navTest mt-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['section']) ? 'active' : ''); ?>" aria-current="page" href="users">Utilisateurs</a>
    </li>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '2')) { ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '2' ? 'active' : ''); ?>" aria-current="page" href=""><?php echo $user_2['prenom']; echo ' '; echo $user_2['nom']; ?></a>
    </li>
    <?php } ?>

</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/gestion_users.php');
}else{
    if ($_GET['section'] == 2){
        include('../vue/gestion_user.php');
    }


}
?>
