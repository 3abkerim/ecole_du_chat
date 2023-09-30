<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div class="col-12 text-end">
  <input type="search" id="produit-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<div class="row">
  <div class="col-12 d-flex justify-content-center">
    <?php if (isset($_SESSION['success_boutique_2'])): ?>
    <div class="alert alert-success mt-3 mx-auto">
      <?= $_SESSION['success_boutique_2'] ?>
    </div>
    <?php unset($_SESSION['success_boutique_2']);  ?>
    <?php endif; ?>
  </div>
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="produits-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Produit</th>
          <th>Date ajouté</th>
          <th>Prix</th>
          <th>Action</th>
          <th>Photos</th>
          <th>En ligne</th>
        </tr>
      </thead>
      <tbody>
      </tbody>


      
    </table>
  </div>
</div>
