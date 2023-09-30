<?php
$form_data_5 = isset($_SESSION['form_data_5']) ? $_SESSION['form_data_5'] : array();
unset($_SESSION['form_data_5']);
?>
<form action="traitement_ajout_article" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_4'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_4'] ?>
  </div>
  <?php unset($_SESSION['error_4']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_4'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_4'] ?>
  </div>
  <?php unset($_SESSION['success_4']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Titre article *</label>
        <div class="col-sm-6">
          <input type="title" name="titre_article" class="form-control" id="exampleFormControlInput1" placeholder="Titre article" value="<?php echo isset($form_data_5['titre_article']) ? htmlspecialchars($form_data_5['titre_article']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Article</label>
        <div class="col-sm-6">
          <textarea name="article" id="chatDescription" class="form-control" id="#" rows="8"><?php echo isset($form_data_5['article']) ? htmlspecialchars($form_data_5['article']) : '' ?></textarea>
        </div>
      </div>

    </div>
    <div class="col-lg-6">

      <div class="mb-3 row">
        <label for="enLigne" class="col-6 col-form-label">Mettre l'article en ligne</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="enLigne" name="enLigne" <?php echo isset($form_data_5['enLigne']) && $form_data_5['enLigne'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>


    </div>

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Ajouter</button>
    </div>
  </div>
</form>
