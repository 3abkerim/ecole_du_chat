<div class="testBk">
  <form class="container userBk2" action="traitement_update_mdp" method="post">
    <aside class="mt-5" id="info-block">
      <section class="file-marker">
        <div>
          <div class="box-title">Modifier mot de passe</div>
          <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger text-center mb-3"><?php echo $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php } ?>
          <div class="box-contents">
            <div action="">
              <div class="mb-3 row mt-3">
                <label for="inputPassword" class="col-sm-6 col-form-label">Ancien mot de passe</label>
                <div class="col-sm-6">
                  <input type="password" name="oldmdp" class="form-control" id="#" placeholder="Ancien mot de passe" />
                </div>
              </div>

              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-6 col-form-label">Nouveau mot de passe</label>
                <div class="col-sm-6">
                  <input type="password" name="mdp" class="form-control" id="#" placeholder="Nouveau mot de passe" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-6 col-form-label">Confirmation mot de passe</label>
                <div class="col-sm-6">
                  <input type="password" name="conMdp" class="form-control" id="#" placeholder="Confirmation mot de passe" />
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
