<?php
if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}
$idChat = isset($_GET['idChat']) ? intval($_GET['idChat']) : 0; // in gestion_adoption.php

$idForm = isset($_GET['idForm']) ? intval($_GET['idForm']) : 0; // in formulaire_adoption_chat.php

$chat = getChatById($bdd,$idChat);

$form = getRequestByID($bdd,$idForm);
?>
<div class="container">
    <div class="row ">
        <div class="col-12">
            <div class="titreGestion mt-3">
                Adoption
            </div>
            <!-- <div class="goldTitre"></div> -->
        </div>
    </div>
</div>

<ul class="nav nav-tabs navTest mt-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['section']) ? 'active' : ''); ?>" aria-current="page" href="adoptions">Demandes d'adoption en cours</a>
    </li>

    <?php if (isset($_GET['section']) && ($_GET['section'] === '3' || $_GET['section'] === '4')) { ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '3' ? 'active' : ''); ?>" aria-current="page" href="gestion_adoption_chat-<?php echo $_SESSION['currentIdChat'];?>">
        <?php
        if ($_GET['section'] === '3') {
            echo $chat['nom_chat'];
        } elseif ($_GET['section'] === '4') {
            echo $form['nom_chat'];
        }
        ?>
        </a>
    </li>
    <?php } ?>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '4')) { ?>
    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '4' ? 'active' : ''); ?>" aria-current="page">Formulaire</a>
    </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link <?php echo ($_GET['section'] === '2'  ? 'active' : ''); ?>" aria-current="page" href="adoptions_confirmes">Adoptions confirmées</a>
    </li>
</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/gestion_adoption.php');
}else{
    if ($_GET['section'] == 2){
        include('../vue/adoption_confirme.php');
    }
    if ($_GET['section'] == 3){
        include('../vue/gestion_adoption_chat.php');
    }
    if ($_GET['section'] == 4){
        include('../vue/formulaire_adoption_chat.php');
    }
}
?>

