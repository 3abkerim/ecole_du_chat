<div class="row">
  <div class="col-12 d-flex justify-content-center">
    <?php if (isset($_SESSION['success_2'])): ?>
    <div class="alert alert-success mt-3 mx-auto">
      <?= $_SESSION['success_2'] ?>
    </div>
    <?php unset($_SESSION['success_2']);  ?>
    <?php endif; ?>
  </div>
</div>

<div class="row">
  <div class="col-12 d-flex justify-content-center">
    <?php if (isset($_SESSION['success_101'])): ?>
    <div class="alert alert-success mt-3 mx-auto">
      <?= $_SESSION['success_101'] ?>
    </div>
    <?php unset($_SESSION['success_101']);  ?>
    <?php endif; ?>
  </div>
</div>

<div class="mt-4 text-center">
    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
    <label class="btn btn-secondary btnChatsBO" for="option1">Chats disponibles</label>
    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
    <label class="btn btn-secondary btnChatsBO" for="option2">Chats adoptés</label>
</div>

<div id="chatsDispo">
  <div class="row">
    <div class="col-12 text-end">
      <input type="search" id="chat-search" class="mt-3 rounded">
      <button class="rounded">Rechercher</button>
    </div>
    <div class="col-md-12 tableau mt-3 bg-light mx-auto">
      <table id="chats-table"  class="table table-hover bg-light mt-2">
        <thead class=" bg-light text-center">
          <tr class="">
            <th>#</th>
            <th>Photo</th>
            <th>Nom</th>
            <th>Référence</th>
            <th>Sexe</th>
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
</div>

<div id="chatsAdoptes" style="display: none;">
  <div class="row">
    <div class="col-12 text-end">
      <input type="search" id="chat-adopte-search" class="mt-3 rounded">
      <button class="rounded">Rechercher</button>
    </div>
    <div class="col-md-12 tableau mt-3 bg-light mx-auto">
      <table id="chats-adoptes-table"  class="table table-hover bg-light mt-2">
        <thead class=" bg-light text-center">
          <tr class="">
            <th>#</th>
            <th>Photo</th>
            <th>Nom</th>
            <th>Référence</th>
            <th>Sexe</th>
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
</div>
