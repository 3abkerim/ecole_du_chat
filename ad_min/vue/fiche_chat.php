<?php
$idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
$chat = getChatById($bdd, $idChat);
?>
<form action="traitement_modif_chat" method="post">
    <input type="hidden" value="<?php echo $idChat; ?>" name="idChat">
  <div class="row mt-5">



  <?php if (isset($_SESSION['success_4'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_4'] ?>
  </div>
  <?php unset($_SESSION['success_4']);  ?>
  <?php endif; ?> 


  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error'] ?>
  </div>
  <?php unset($_SESSION['error']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Nom chat *</label>
        <div class="col-sm-6">
          <input type="title" name="nom_chat" class="form-control" id="exampleFormControlInput1" placeholder="Nom chat" value="<?php echo isset($chat['nom_chat']) ? htmlspecialchars($chat['nom_chat']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatSexe" class="col-sm-6 col-form-label">Sexe *</label>
        <div class="col-sm-6">
        <select class="form-select" aria-label="Default select example" name="sexe" required>
            <option selected disabled>Sexe</option>
            <?php
            $sexes = getSexeChats($bdd);
            foreach ($sexes as $sexe) {
            ?>
                <option value="<?php echo $sexe['id_sexe'] ?>" <?php echo (isset($chat['sexe_id_sexe']) && $chat['sexe_id_sexe'] == $sexe['id_sexe']) ? 'selected' : '' ?> ><?php echo $sexe['sexe'] ?></option>
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
            <option value="<?php echo $race['id_race'] ?>" <?php echo isset($chat['race_id_race']) && $chat['race_id_race'] == $race['id_race'] ? 'selected' : '' ?> > <?php echo $race['race'] ?></option>
            <?php
                }
                ?>
          </select>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDob" class="col-sm-6 col-form-label">Date naissance</label>
        <div class="col-sm-6">
          <input type="date" name="dob" class="form-control" id="chatDob" placeholder="Nom chat" value="<?php echo isset($chat['age']) ? htmlspecialchars($chat['age']) : '' ?>" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="identification" class="col-sm-6 col-form-label">Identification</label>
        <div class="col-sm-6">
          <input type="text" name="identification" class="form-control" id="identification" placeholder="Identification" value="<?php echo isset($chat['identifiant']) ? htmlspecialchars($chat['identifiant']) : '' ?>" />
        </div>
      </div>


      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Description chat</label>
        <div class="col-md-12">
          <textarea name="chatDescription" id="chatDescription" class="form-control" id="#" rows="5"><?php echo isset($chat['description']) ? htmlspecialchars($chat['description']) : '' ?></textarea>
        </div>
      </div>

    </div>
    <div class="col-lg-6">


      <div class="mb-3 row">
        <label for="sterilisation" class="col-6 col-form-label">Le chat est stérilisé</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="sterilisation" name="sterilisation" <?php echo isset($chat['sterilise']) && $chat['sterilise'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="fiv" class="col-6 col-form-label">Le chat est vacciné contre le FIV</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="fiv" name="fiv" <?php echo isset($chat['fiv']) && $chat['fiv'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="flv" class="col-6 col-form-label">Le chat est vacciné contre le FLV</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="flv" name="flv" <?php echo isset($chat['flv']) && $chat['flv'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="enLigne" class="col-6 col-form-label">Le chat est adopté hors site</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="enLigne" name="adopte" >
        </div>
      </div>



    </div>

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Mettre à jour</button>
    </div>
  </div>
</form>
