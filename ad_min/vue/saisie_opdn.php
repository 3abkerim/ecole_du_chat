<?php
$form_data_11 = isset($_SESSION['form_data_11']) ? $_SESSION['form_data_11'] : array();
unset($_SESSION['form_data_11']);
?>
<form action="traitement_ajout_opdn" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_opdn'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_opdn'] ?>
  </div>
  <?php unset($_SESSION['error_opdn']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_opdn'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_opdn'] ?>
  </div>
  <?php unset($_SESSION['success_opdn']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Titre article *</label>
        <div class="col-sm-6">
          <input type="title" name="titre" class="form-control" id="exampleFormControlInput1" placeholder="Titre article" value="<?php echo isset($form_data_11['titre']) ? htmlspecialchars($form_data_11['titre']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Nom site ou journal *</label>
        <div class="col-sm-6">
          <input type="title" name="par_qui" class="form-control" id="exampleFormControlInput1" placeholder="Site / Journal" value="<?php echo isset($form_data_11['par_qui']) ? htmlspecialchars($form_data_11['par_qui']) : '' ?>" require />
        </div>
      </div>

    </div>
    <div class="col-lg-6">
    <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Lien article *</label>
        <div class="col-sm-6">
            <input type="url" class="form-control" value="<?php echo isset($form_data_11['lien']) ? htmlspecialchars($form_data_11['lien']) : '' ?>" name="lien">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Date publication *</label>
        <div class="col-sm-6">
            <input type="date" class="form-control" value="<?php echo isset($form_data_11['date_pub']) ? htmlspecialchars($form_data_11['date_pub']) : '' ?>" name="date_pub" require>
        </div>
      </div>

    </div>


    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Ajouter</button>
    </div>
  </div>
</form>
