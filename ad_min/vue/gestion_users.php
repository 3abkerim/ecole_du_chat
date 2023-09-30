<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<div class="col-12 text-end">
  <input type="search" id="user-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="users-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Adresse mail</th>
          <th>Numéro de téléphone</th>
          <th>Rôle</th>
          <th>Gestion</th>
        </tr>

      </thead>
      <tbody>

      </tbody>



    </table>
  </div>
</div>


