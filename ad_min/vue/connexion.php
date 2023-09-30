<?php
	if (isset($_SESSION['idUserAdmin'])){
		header('Location:tableau_de_bord');
	}

?>
<div class="connexionBO mt-5 p-5 mx-auto">
    <div class="logo text-center mb-4">
        <img src="public/assets/images/logo-edc-rvb-sans-fond.png" alt="">
    </div>

    <?php if (isset($_SESSION['error_login'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error_login'] ?>
    </div>
    <?php unset($_SESSION['error_login']);  ?>
    <?php endif; ?>


    <form class="formBO" method="post" action="traitement_connexion">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email" name="email">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Votre mot de passe" name="mdp">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
        </div> -->
        <div class="text-center mt-5">
            <button  type="submit" class="btn btn-primary btnConnexion">Connexion</button>
        </div>
    </form>
</div>
