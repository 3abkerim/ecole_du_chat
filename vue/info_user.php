<?php
$image = getImageUser($bdd,$user['id_user']);

?>
<div class="testBk">
  <form class="container userBk2" action="traitement_update_info" method="post">
  <?php if(isset($_SESSION['editInfo'])) { ?>
    <div class="alert alert-success text-center mb-3"><?php echo $_SESSION['editInfo']; ?></div>
    <?php unset($_SESSION['editInfo']); ?>
  <?php } ?>
    <aside class="mt-5" id="info-block">
      <section class="file-marker">
        <div>
          <div class="box-title">Modifier infos personnelles</div>
          <div class="box-contents">
            <div class="mt-2">
              <div class="mb-3 row">
                <label for="nom" class="col-sm-6 col-form-label">Nom</label>
                <div class="col-sm-6">
                  <input type="name" class="form-control" id="nom" value="<?php echo $user['nom']; ?>" name="nom" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="prenom" class="col-sm-6 col-form-label">Prénom</label>
                <div class="col-sm-6">
                  <input type="name" class="form-control" id="prenom" value="<?php echo $user['prenom']; ?>" name="prenom" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="dob" class="col-sm-6 col-form-label">Date de naissance</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['date_naissance'] ?>" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="adresse" class="col-sm-6 col-form-label">Adresse</label>
                <div class="col-sm-6">
                  <input type="adresse" class="form-control" id="adresse" value="<?php echo $user['adresse']; ?>" name="adresse" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="departement" class="col-sm-6 col-form-label">Département</label>
                <div class="col-sm-6">
                  <select type="departement" class="form-select" id="departement" name="departement">
                    <option selected disabled>Département</option>
                    <?php foreach ($departements as $departement){ ?>
                    <option value="<?php echo $departement['id_departement'];?>" <?php echo ($user['id_departement'] == $departement['id_departement']) ? 'selected' : ''; ?> ><?php echo $departement['nom_departement'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="ville" class="col-sm-6 col-form-label">Ville</label>
                <div class="col-sm-6">
                  <select name="ville" type="ville" class="form-select" id="ville">
                    <option selected disabled>Ville</option>
                    <?php foreach ($villes as $ville) { ?>
                      <option value="<?php echo $ville['id_ville']; ?>" <?php echo ($ville['id_ville'] == $user['id_ville']) ? 'selected' : ''; ?>><?php echo $ville['nom_ville']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="email" class="col-sm-6 col-form-label">Email</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" name="email" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="image" class="col-sm-6 col-form-label">Photo de profil</label>
                <div class="col-sm-6">
                <div class="col-sm-6">
                  <a class="btn btn-primary btnInfo" href="modifiePhotoDeProfil">Modifier</a>
                </div>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="email" class="col-sm-6 col-form-label">Mot de passe</label>
                <div class="col-sm-6">
                  <a class="btn btn-primary btnInfo" href="modifieMdp">Modifier</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </aside>

    <div class="d-flex justify-content-center mt-3">
      <button type="submit" class="btn btn-primary btnForm" name="btnsubmitinscription">Modifier</button>
    </div>
  </form>
</div>