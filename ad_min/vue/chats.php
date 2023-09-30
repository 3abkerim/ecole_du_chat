<?php
if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            Chats
        </div>
        <!-- <div class="goldTitre"></div> -->
    </div>
</div>

<?php 
$idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
$chat = getChatById($bdd, $idChat);
?>
<ul class="nav nav-tabs navbiens mt-3">
  <li class="nav-item">
    <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="chats">Saisie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="gestion_chats">Gestion</a>
  </li>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '3')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" href="fiche_chat"><?php echo $chat['nom_chat']; ?></a>
  </li>
  <?php } ?>
  <?php if (isset($_GET['section']) && ($_GET['section'] === '4')){ ?>
  <li class="nav-item">
    <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '4' ? ' active' : ''); ?>" aria-current="page" href="saisie_photos_chat">Photos de <?php echo $chat['nom_chat']; ?></a>
  </li>
  <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])){
    include('../vue/saisie_chat.php');
}else{
if ($_GET['section'] == 2){
    include ('../vue/gestion_chats.php');
}
if ($_GET['section'] == 3){
  include ('../vue/fiche_chat.php');
}
if ($_GET['section'] == 4){
  include ('../vue/saisie_photos_chat.php');
}


}

?>