<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  
  $form_data_inscription = isset($_SESSION['form_data_inscription']) ? $_SESSION['form_data_inscription'] : array();
  unset($_SESSION['form_data_inscription']);
  
  ?>
<div class="container-fluid conFluid testBk content">
  <section>
    <div class="container formBk">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Inscrivez-vous !</div>
        <div class="col-12 text-center kitty"><img src="public/assets/images/kitty.png" alt="" /></div>
      </div>
      <div class="row mt-3">
        <form id="inscription" class="col-md-6 signIn mx-auto" method="POST" action="traitement_inscription">
          <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
          <div class="row">
            <div class="col-12">
              <?php
                if(isset($_SESSION['erreur'])){
                  echo '<p class="alert alert-danger">'.$_SESSION['erreur'].'</p>';
                  unset($_SESSION['erreur']);
                }
                
                ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Civilité</label>
            <div class="col-sm-6">
              <select type="departement" class="form-select" id="civilite" name="civilite" value="<?php echo isset($form_data_inscription['civilite']) ? htmlspecialchars($form_data_inscription['civilite']) : '' ?>">
                <option selected disabled>Civilité</option>
                <?php
                  $sexes = getCivliteUser($bdd);                
                  foreach ($sexes as $sexe){ 
                  ?>
                <option value="<?php echo $sexe['id_civilite'];?>" 
                  <?php echo (isset($form_data_inscription['civilite']) && $form_data_inscription['civilite'] == $sexe['id_civilite']) ? 'selected' : ''; ?>>
                  <?php echo $sexe['civilite'];?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Nom</label>
            <div class="col-sm-6">
              <input type="text" name="nom" class="form-control" id="#" placeholder="Nom" value="<?php echo isset($form_data_inscription['nom']) ? htmlspecialchars($form_data_inscription['nom']) : '' ?>" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Prénom</label>
            <div class="col-sm-6">
              <input type="text" name="prenom" class="form-control" id="#" placeholder="Prénom" value="<?php echo isset($form_data_inscription['prenom']) ? htmlspecialchars($form_data_inscription['prenom']) : '' ?>" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Date de naissance</label>
            <div class="col-sm-6">
              <input type="date" name="dob" class="form-control" id="#" placeholder="Prénom" value="<?php echo isset($form_data_inscription['dob']) ? htmlspecialchars($form_data_inscription['dob']) : '' ?>" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Adresse</label>
            <div class="col-sm-6">
              <input type="adresse" name="adresse" class="form-control" id="#" placeholder="Adresse" value="<?php echo isset($form_data_inscription['adresse']) ? htmlspecialchars($form_data_inscription['adresse']) : '' ?>" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Département</label>
            <div class="col-sm-6">
              <select type="departement" class="form-select" id="departement" name="departement" value="<?php echo isset($form_data_inscription['departement']) ? htmlspecialchars($form_data_inscription['departement']) : '' ?>">
                <option selected disabled>Département</option>
                <?php
                  $departements =  getDep($bdd);
                  foreach ($departements as $departement){ 
                  ?>
                <option value="<?php echo $departement['id_departement'];?>" 
                  <?php echo (isset($form_data_inscription['departement']) && $form_data_inscription['departement'] == $departement['id_departement']) ? 'selected' : '';?>>
                  <?php echo $departement['nom_departement'];?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Ville</label>
            <div class="col-sm-6">
              <select name="ville" type="ville" class="form-select" id="ville">
                <option selected disabled>Ville</option>
                <?php
                  // You should fetch your city data here like you did for 'Département' and 'Civilité'
                  $villes = getToutVilles($bdd);
                  foreach ($villes as $ville) { 
                  ?>
                <option value="<?php echo $ville['id_ville'];?>"
                  <?php echo (isset($form_data_inscription['ville']) && $form_data_inscription['ville'] == $ville['id_ville']) ? 'selected' : ''; ?>>
                  <?php echo $ville['nom_ville'];?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Numéro de téléphone</label>
            <div class="col-sm-6">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+33</span>
                <input type="text" name="numero" class="form-control" id="#" placeholder="6XXXXXXXX" pattern="\d{9}" onkeypress="return isNumber(event)" value="<?php echo isset($form_data_inscription['numero']) ? htmlspecialchars($form_data_inscription['numero']) : '' ?>" />
              </div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Email</label>
            <div class="col-sm-6">
              <input type="email" name="email" class="form-control" id="#" placeholder="name@example.com" value="<?php echo isset($form_data_inscription['email']) ? htmlspecialchars($form_data_inscription['email']) : '' ?>" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Mot de passe</label>
            <div class="col-sm-6">
              <input type="password" name="mdp" class="form-control" id="#" placeholder="Mot de passe"  />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Confirmation mot de passe</label>
            <div class="col-sm-6">
              <input type="password" name="conmdp" class="form-control" id="#" placeholder="Confirmation" />
            </div>
          </div>
          <div class="d-flex justify-content-center mt-2 mb-5">
            <button type="submit" class="btn btn-primary btnForm g-recaptcha" name="btnsubmitinscription">S'inscrire</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>