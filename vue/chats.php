<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  // require '../modele/connexion_pdo.php';
  // require '../modele/fonctions.php';
  
  
  ?>
<?php 
  $chats = getChatsEnLigne($bdd); 
  if(count($chats)>0){
  ?>
<div class="mainBk2 container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Chats à l'adoption</div>
      </div>
      <div class="row mt-4">
        <div class="col-12 text-center subNosChats">Sexe</div>
      </div>
      <div class="row text-center justify-content-center mt-4">
        <div class="col-12 d-flex gapbtns">
          <input type="radio" class="btn-check gender" name="btn-group" id="btn-check0" autocomplete="off" value="any" checked />
          <label class="btn btn-primary btnChat" for="btn-check0">PEU IMPORTE</label>
          <input type="radio" class="btn-check gender" name="btn-group" id="btn-check1" autocomplete="off" value="male" />
          <label class="btn btn-primary btnChat" for="btn-check1">MÂLE</label>
          <input type="radio" class="btn-check gender" name="btn-group" id="btn-check2" autocomplete="off" />
          <label class="btn btn-primary btnChat" for="btn-check2">FEMELLE</label>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 text-center subNosChats">Age</div>
      </div>
      <div class="row text-center justify-content-center mt-4">
        <div class="col-12 d-flex gapbtns">
          <input type="radio" class="btn-check age" name="btn-group2" id="btn-check3" autocomplete="off" value="any" checked />
          <label class="btn btn-primary btnChat" for="btn-check3">PEU IMPORTE</label>
          <input type="radio" class="btn-check age" name="btn-group2" id="btn-check4" autocomplete="off" value="kitten" />
          <label class="btn btn-primary btnChat" for="btn-check4">CHATONS</label>
          <input type="radio" class="btn-check age" name="btn-group2" id="btn-check5" autocomplete="off" />
          <label class="btn btn-primary btnChat" for="btn-check5">ADULTES</label>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="row mt-5" id="cats-section">
    </div>
  </section>
</div>
<?php }else{ ?>
  <div class="mainBk2 container-fluid conFluid">
<?php
  include '/home/ecoledl/www/vue/chats_indisponible.php';
  ?>
</div>
<?php } ?>