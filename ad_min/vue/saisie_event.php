<?php
$form_data_10 = isset($_SESSION['form_data_10']) ? $_SESSION['form_data_10'] : array();
unset($_SESSION['form_data_10']);
?>
<form action="traitement_ajout_event" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_10'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_10'] ?>
  </div>
  <?php unset($_SESSION['error_10']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_10'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_10'] ?>
  </div>
  <?php unset($_SESSION['success_10']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Titre évènement *</label>
        <div class="col-sm-6">
          <input type="title" name="nom" class="form-control" id="exampleFormControlInput1" placeholder="Titre évènement" value="<?php echo isset($form_data_10['nom']) ? htmlspecialchars($form_data_10['nom']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Date évènement *</label>
        <div class="col-sm-6">
            <input type="datetime-local" class="form-control" value="<?php echo isset($form_data_10['date_event']) ? htmlspecialchars($form_data_10['date_event']) : '' ?>" name="date_event" require>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Date fin évènement</label>
        <div class="col-sm-6">
            <input type="datetime-local" class="form-control" value="<?php echo isset($form_data_10['date_fin_event']) ? htmlspecialchars($form_data_10['date_fin_event']) : '' ?>" name="date_fin_event">
        </div>
      </div>

    </div>
    <div class="col-lg-6">

      <div class="mb-3 row">
        <label for="enLigne" class="col-6 col-form-label">Mettre l'évènement en ligne</label>
        <div class="col-6 d-flex align-items-center">
          <input class="form-check-input" type="checkbox" value="1" id="enLigne" name="enLigne" <?php echo isset($form_data_10['enLigne']) && $form_data_10['enLigne'] == 1 ? 'checked' : '' ?> >
        </div>
      </div>


    </div>

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Ajouter</button>
    </div>
  </div>
</form>
