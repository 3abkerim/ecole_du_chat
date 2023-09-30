<?php
  $idUser = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $token = isset($_GET['token']) ? $_GET['token'] : "";
  
  $resetEntry = getPasswordResetEntry($bdd, $idUser, $token);
  
  if (!$resetEntry) {
      header('Location:accueil');
      exit();
  }
  
  $expiresAt = strtotime($resetEntry['date_expiration']);
  $now = time();
  
  if ($now > $expiresAt) {
      $_SESSION['error_reset'] = 'Your reset token has expired.';
      header('Location:mdp_oublie');
      exit();
  }
  
  ?>
<div class="container-fluid conFluid testBk content">
  <section>
    <div class="container formBk">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Reinstallez votre mot de passe</div>
        <div class="col-12 text-center kitty"><img src="public/assets/images/kitty.png" alt="" /></div>
      </div>
      
      <?php if (isset($_SESSION['error_reset'])){ ?>
      <div class="row mt-2">
        <div class="col-12 text-center red">
          <?php echo $_SESSION['error_reset']; ?>
        </div>
      </div>
      <?php
        }
        unset($_SESSION['error_reset']); 
        ?>

      <?php if (isset($_SESSION['mdpfail'])){ ?>
      <div class="row mt-2">
        <div class="col-12 text-center red">
          <?php echo $_SESSION['mdpfail']; ?>
        </div>
      </div>
      <?php
        }
        unset($_SESSION['mdpfail']); 
        ?>
      <div class="row mt-2">
        <form class="col-md-6 signIn mx-auto" action="traitement_reinstaller_mdp" method="post">
          <input type="hidden" value="<?php echo $token; ?>" name="token"> 
          <input type="hidden" value="<?php echo $idUser; ?>" name="idUser">
          <div class="titreGoldLine"></div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-12 col-form-label">Nouveau mot de passe</label>
            <div class="col-12">
              <input type="password" name="mdp" class="form-control" id="inputPassword" />
            </div>
          </div>
          <div class="mb-5 row">
            <label for="inputPassword" class="col-12 col-form-label">Confirmation nouveau mot de passe</label>
            <div class="col-12">
              <input type="password" name="mdp_confirm" class="form-control" id="inputPassword" />
            </div>
          </div>
          <div class="d-flex justify-content-center mt-2 parentBtnForm mb-4">
            <button type="submit" class="btn btn-primary btnForm">Valider</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>