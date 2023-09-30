<?php
$idEvent = isset($_GET['id']) ? intval($_GET['id']) : 0;
$event = getEventById($bdd, $idEvent);
$user = getUserById($bdd,$event['id_user']);
?>
<form action="traitement_modif_event" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_12'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_12'] ?>
  </div>
  <?php unset($_SESSION['error_12']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_12'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_12'] ?>
  </div>
  <?php unset($_SESSION['success_12']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Titre évènement *</label>
        <div class="col-sm-6">
          <input type="title" name="event" class="form-control" id="exampleFormControlInput1" placeholder="Titre évènement" value="<?php echo isset($event['event']) ? htmlspecialchars($event['event']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="date_event" class="col-sm-6 col-form-label">Date évènement *</label>
        <div class="col-sm-6">
        <?php
        $dateEvent = new DateTime($event['date_event']);
        $formattedDateEvent = $dateEvent->format('Y-m-d\TH:i');
        ?>
        <input type="datetime-local" value="<?php echo $formattedDateEvent; ?>" name="date_event" required>

        </div>
      </div>

      <div class="mb-3 row">
        <label for="date_fin_event" class="col-sm-6 col-form-label">Date fin évènement</label>
        <div class="col-sm-6">
        <?php
        if($event['date_fin_event'] !== NULL) {
            $dateFinEvent = new DateTime($event['date_fin_event']);
            $formattedDateFinEvent = $dateFinEvent->format('Y-m-d\TH:i');
        } else {
            $formattedDateFinEvent = '';
        }
        ?>
        <input type="datetime-local" value="<?php echo $formattedDateFinEvent; ?>" name="date_fin_event">
        </div>
      </div>
    </div>


    <input type="hidden" name="id_event" value="<?php echo $idEvent; ?>">

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Mettre à jour</button>
    </div>
  </div>
</form>
