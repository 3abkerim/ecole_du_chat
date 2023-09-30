<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  $idChat = isset($_GET['idChat']) ? intval($_GET['idChat']) : null;
  
  if ($idChat === null) {
    header('Location: error_page.php');
    exit();
  }
  
  
  if (isset($_SESSION['currentIdChat'])) {
      $idChat = $_SESSION['currentIdChat'];
      unset($_SESSION['currentIdChat']); 
  } else {
      $idChat = isset($_GET['idChat']) ? intval($_GET['idChat']) : 0;
  }
  
  $demandes = getRequestsForCat($bdd, $idChat);
  $chat = getChatById($bdd,$idChat);
  ?>
<div class="col-12 text-end">
  <input type="search" id="demande-ad-chat-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>
<div class="row text-center">
  <div class="col-12 h5">Demandes d'adoption pour <?php echo $chat['nom_chat']; ?></div>
</div>
<?php if (isset($_SESSION['success_ad_delete'])): ?>
<div class="alert alert-success">
  <?= $_SESSION['success_ad_delete'] ?>
</div>
<?php unset($_SESSION['success_ad_delete']);  ?>
<?php endif; ?>
<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="demandes-ad-chat-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Réference</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Date demande</th>
          <th>Formulaire</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<script>
  var idChat = <?php echo json_encode($idChat); ?>;
</script>