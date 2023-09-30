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
<div class="col-12 text-end">
  <input type="search" id="event-search" name="q" class="mt-3 rounded">
  <button class="rounded">Rechercher</button>
</div>

<div class="row">
  <div class="col-12 d-flex justify-content-center">
    <?php if (isset($_SESSION['success_11'])): ?>
    <div class="alert alert-success mt-3 mx-auto">
      <?= $_SESSION['success_11'] ?>
    </div>
    <?php unset($_SESSION['success_11']);  ?>
    <?php endif; ?>
  </div>
  <div class="col-md-12 tableau mt-3 bg-light mx-auto">
    <table id="events-table" class="table table-hover bg-light mt-2">
      <thead class="titreTable bg-light text-center">
        <tr>
          <th>#</th>
          <th>Évènement</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Date publication</th>
          <th>Action</th>
          <th>Affiche</th>
          <th>En ligne</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      
    </table>
  </div>
</div>
