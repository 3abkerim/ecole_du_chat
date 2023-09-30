<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['idChat'])) {
    $idChat = intval($_GET['idChat']);
    $_SESSION['currentIdChat'] = $idChat;
}


?>


<div class="col-12 text-end">
  <input type="search" id="demande-ad-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<div class="row">
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="demandes-ad-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Nom chat</th>
          <th>Référence chat</th>
          <th>Demandes d'adoption</th>
        </tr>
        <tbody>

        </tbody>

      </thead>


    </table>
  </div>
</div>


