<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




?>
<!-- <div class="row mt-4">
  <div class="col-3">
    <div class="input-group rounded search_1">
      <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      <span class="input-group-text border-0 search" id="search-addon">
        <img src="../public/assets/images/magnifying-glass.png" alt="">
      </span>
    </div>
  </div>
</div> -->

<?php if (isset($_SESSION['success_ad_delete_2'])): ?>
<div class="alert alert-success mt-2">
  <?= $_SESSION['success_ad_delete_2'] ?>
</div>
<?php unset($_SESSION['success_ad_delete_2']);  ?>
<?php endif; ?>

<div class="col-12 text-end">
  <input type="search" id="ad-confirme-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="ad-confirme-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Référence chat</th>
          <th>Nom chat</th>
          <th>Adoptant</th>
          <th>Date d'adoption</th>
          <th>Générer un contrat</th>
          <th>Annuler adoption</th>
        </tr>
        <tbody>

        </tbody>

      </thead>


    </table>
  </div>
</div>


