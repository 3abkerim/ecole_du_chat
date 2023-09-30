<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (isset($_GET['idChat'])) {
//     $idChat = intval($_GET['idChat']);
//     $_SESSION['currentIdChat'] = $idChat;
// }


?>


<div class="col-12 text-end">
  <input type="search" id="fa-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<?php if (isset($_SESSION['success_fa_delete_2'])): ?>
  <div class="row text-center">
      <div class="col-12 greenSuccess"><?= $_SESSION['success_fa_delete_2'] ?></div>
  </div>
<?php unset($_SESSION['success_fa_delete_2']);  ?>
<?php endif; ?>


<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="fa-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Chats en accueil</th>
          <th>Gestion</th>
          <th>Supprimer</th>
        </tr>

      </thead>
      <tbody>

      </tbody>


      
    </table>
  </div>
</div>


