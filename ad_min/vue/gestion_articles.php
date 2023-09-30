<div class="col-12 text-end">
   <input type="search" id="articles-search" name="q" class="mt-3 rounded">
   <button class="rounded">Rechercher</button>
</div>
<div class="row">
   <div class="col-12 d-flex justify-content-center">
      <?php if (isset($_SESSION['success_5'])): ?>
      <div class="alert alert-success mt-3 mx-auto">
         <?= $_SESSION['success_5'] ?>
      </div>
      <?php unset($_SESSION['success_5']);  ?>
      <?php endif; ?>
   </div>
   <div class="col-md-12 tableau mt-3 bg-light mx-auto">
      <table id="articles-table" class="table table-hover bg-light mt-2">
        <thead class="titreTable bg-light text-center">
          <tr class="">
              <th>#</th>
              <th>Photo</th>
              <th>Titre article</th>
              <th>Réference</th>
              <th>Action</th>
              <th>Images</th>
              <th>En ligne</th>
          </tr>
        </thead>

        <tbody>
        </tbody>

      </table>
   </div>
</div>