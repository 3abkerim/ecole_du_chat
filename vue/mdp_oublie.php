<div class="container-fluid conFluid testBk content">
  <section>
    <div class="container formBk">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Mot de passe oublié?</div>
        <div class="col-12 text-center kitty"><img src="public/assets/images/kitty.png" alt="" /></div>
      </div>
      <?php if (isset($_SESSION['mdpoublie'])){ ?>
      <div class="row mt-2">
        <div class="col-12 text-center green">
          <?php echo $_SESSION['mdpoublie']; ?>
        </div>
      </div>
      <?php
      }
      unset($_SESSION['mdpoublie']); 
      ?>
      <div class="row mt-2">
        <form class="col-md-6 signIn mx-auto" action="traitement_mdp_oublie" method="post">
          <div class="mb-3">Envoyer un lien de réinitialisation</div>
          <div class="titreGoldLine"></div>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
            </div>
          </div>
          <div class="d-flex justify-content-center mt-2 parentBtnForm mb-4">
            <button type="submit" class="btn btn-primary btnForm">Envoyer</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
