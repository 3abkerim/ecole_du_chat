<?php
$form_data_3 = isset($_SESSION['form_data_3']) ? $_SESSION['form_data_3'] : array();
unset($_SESSION['form_data_3']);
?>
<form action="traitement_ajout_chat" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error'] ?>
  </div>
  <?php unset($_SESSION['error']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success'] ?>
  </div>
  <?php unset($_SESSION['success']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Nom chat *</label>
        <div class="col-sm-6">
          <input type="title" name="nom_chat" class="form-control" id="exampleFormControlInput1" placeholder="Nom chat" value="<?php echo isset($form_data_3['nom_chat']) ? htmlspecialchars($form_data_3['nom_chat']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatSexe" class="col-sm-6 col-form-label">Sexe *</label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select example" name="sexe" require>
            <option selected disabled>Sexe</option>
            <?php
                $sexes = getSexeChats($bdd);
                foreach ($sexes as $sexe){
                ?>
            <option value="<?php echo $sexe['id_sexe'] ?>" <?php echo isset($form_data_3['sexe']) && $form_data_3['sexe'] == $sexe['id_sexe'] ? 'selected' : '' ?> ><?php echo $sexe['sexe'] ?></option>
            <?php
                }
                ?>
          </select>
        </div>
      </div>


      <div class="mb-3 row">
        <label for="chatRace" class="col-sm-6 col-form-label">Race</label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select example" name="race">
            <option selected disabled>Race</option>
            <?php
                $races = getRacesChats($bdd);
                foreach ($races as $race){
                ?>
            <option value="<?php echo $race['id_race'] ?>" <?php echo isset($form_data_3['race']) && $form_data_3['race'] == $sexe['id_race'] ? 'selected' : '' ?> > <?php echo $race['race'] ?></option>
            <?php
                }
                ?>
          </select>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDob" class="col-sm-6 col-form-label">Date naissance</label>
        <div class="col-sm-6">
          <input type="date" name="dob" class="form-control" id="chatDob" placeholder="Nom chat" value="<?php echo isset($form_data_3['dob']) ? htmlspecialchars($form_data_3['dob']) : '' ?>" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="identification" class="col-sm-6 col-form-label">Identification</label>
        <div class="col-sm-6">
          <input type="text" name="identification" class="form-control" id="identification" placeholder="Identification" value="<?php echo isset($form_data_3['identification']) ? htmlspecialchars($form_data_3['identification']) : '' ?>"  />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Description chat</label>
        <div class="col-sm-6">
          <textarea name="chatDescription" id="chatDescription" class="form-control" id="#" rows="3"><?php echo isset($form_data_3['chatDescription']) ? htmlspecialchars($form_data_3['chatDescription']) : '' ?></textarea>
        </div>
      </div>

    </div>
    <div class="col-lg-6">


      <div class="mb-3 row">
        <label for="sterilisation" class="col-6 col-form-label">Le chat est stérilisé</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="sterilisation" name="sterilisation" <?php echo isset($form_data_3['sterilisation']) && $form_data_3['sterilisation'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="fiv" class="col-6 col-form-label">Le chat est vacciné contre le FIV</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="fiv" name="fiv" <?php echo isset($form_data_3['fiv']) && $form_data_3['fiv'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="flv" class="col-6 col-form-label">Le chat est vacciné contre le FLV</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="flv" name="flv" <?php echo isset($form_data_3['flv']) && $form_data_3['flv'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="enLigne" class="col-6 col-form-label">Mettre le chat en adoption</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="enLigne" name="enLigne" <?php echo isset($form_data_3['enLigne']) && $form_data_3['enLigne'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>



    </div>

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Ajouter</button>
    </div>
  </div>
</form>
