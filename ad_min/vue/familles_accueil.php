<?php
if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}
$idChat = isset($_GET['idChat']) ? intval($_GET['idChat']) : 0; 

$idForm = isset($_GET['idForm2']) ? intval($_GET['idForm2']) : 0; 

$idUser = isset($_GET['id']) ? intval($_GET['id']) : 0; 

$user = getUserById($bdd,$idUser);

$chat = getChatById($bdd,$idChat);

$form = getRequestByID($bdd,$idForm);
?>
<div class="container">
    <div class="row ">
        <div class="col-12">
            <div class="titreGestion mt-3">
                Familles d'accueil
            </div>
            <!-- <div class="goldTitre"></div> -->
        </div>
    </div>
</div>

<ul class="nav nav-tabs navTest mt-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['section']) ? 'active' : ''); ?>" aria-current="page" href="familles_accueil">Familles d'accueil</a>
    </li>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '3')) { ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '3' ? 'active' : ''); ?>" aria-current="page" href=""><?php echo $user['prenom']; echo ' '; echo $user['nom']; ?></a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section']=='2' ? 'active' : ''); ?>" aria-current="page" href="demandes_familles_accueil">Gestion demandes familles d'accueil</a>
    </li>

    <?php if (isset($_GET['section']) && ($_GET['section'] === '4')) { ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '4' ? 'active' : ''); ?>" aria-current="page" href="fiche_demande_fa-<?php echo $_GET['idForm'];?>">Formulaire</a>
    </li>
    <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/gestion_fa.php');
}else{
    if ($_GET['section'] == 2){
        include('../vue/demandes_fa.php');
    }
    if ($_GET['section'] == 3){
        include('../vue/fiche_famille.php');
    }
    if ($_GET['section'] == 4){
        include('../vue/formulaire_famille_accueil.php');
    }
}
?>

