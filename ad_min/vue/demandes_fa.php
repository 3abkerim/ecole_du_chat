<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<div class="col-12 text-end">
  <input type="search" id="demandes-fa-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>


<div class="row text-center">
      <div class="col-12 h5 mt-3">Demandes pour devenir une famille d'accueil</div>
</div>

<?php if (isset($_SESSION['success_fa_delete'])): ?>
  <div class="row text-center">
      <div class="col-12 greenSuccess"><?= $_SESSION['success_fa_delete'] ?></div>
  </div>
<?php unset($_SESSION['success_fa_delete']);  ?>
<?php endif; ?>

<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="demandes-fa-table" class="table table-hover bg-light mt-2">
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

