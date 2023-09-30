<?php
	if (isset($_SESSION['idUser'])){
		header('Location:espace_user');
	}

?>
<div class="container-fluid conFluid testBk content">
  <section>
    <div class="container formBk">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Bienvenue, veuillez vous identifier</div>
        <div class="col-12 text-center kitty"><img src="public/assets/images/kitty.png" alt="" /></div>
      </div>
      <div class="row mt-3 p-2">
        <form class="col-md-6 signIn mx-auto" method="post" action="traitement_connexion" >
          <div class="mb-3">Vous êtes déjà inscrit ?</div>
          <div class="titreGoldLine"></div>
          <?php
            if (isset($_SESSION['error'])){
          ?>
          <p class="alert alert-danger"><?php echo $_SESSION['error']; ?></p>
          <?php
            unset($_SESSION['error']);
            }
          ?>
          <?php
            if (isset($_SESSION['mdpchange'])){
          ?>
          <p class="alert alert-success"><?php echo $_SESSION['mdpchange']; ?></p>
          <?php
            unset($_SESSION['mdpchange']);
            }
          ?>
          <?php
            if (isset($_SESSION['mdpsuccess'])){
          ?>
          <p class="alert alert-success"><?php echo $_SESSION['mdpsuccess']; ?></p>
          <?php
            unset($_SESSION['mdpsuccess']);
            }
          ?>
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
            </div>
          </div>
          <div class="mb-5 row">
            <label for="inputPassword" class="col-sm-3 col-form-label">Mot de passe</label>
            <div class="col-sm-9">
              <input type="password" name="mdp" class="form-control" id="inputPassword" />
            </div>
            <a href="mdp_oublie" class="mt-1 text-end">Mot de passe oublié?</a>
          </div>
          <div class="d-flex justify-content-center mt-2 parentBtnForm">
            <button type="submit" class="btn btn-primary btnForm">Se connecter</button>
          </div>
          <div class="mt-4">Vous n'êtes pas encore inscrit ? <a href="inscription">Inscrivez-vous</a></div>
        </form>
      </div>
      <div class="m-4 text-center">En continuant, vous acceptez les Conditions d'utilisation et vous confirmez avoir lu la Politique de confidentialité de l'école du chat.</div>
    </div>
  </section>
</div>
