<?php
  $idProduit = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $produit = getProduitById($bdd,$idProduit);
  ?>
<div class="container content">
  <div class="nosChats text-center display-4 mt-5">
    Nous contacter
  </div>
  <div class="row">
    <div class="col-12 mt-2">
      <?php
        if(isset($_SESSION['mail_success'])){
          echo '<p class="alert alert-success">'.$_SESSION['mail_success'].'</p>';
          unset($_SESSION['mail_success']);
        }
        
        ?>
      <?php
        if(isset($_SESSION['mail_fail'])){
          echo '<p class="alert alert-danger">'.$_SESSION['mail_fail'].'</p>';
          unset($_SESSION['mail_fail']);
        }
        
        ?>
    </div>
  </div>
  <div class="c1">
    <p class="io mt-3">* Information obligatoire</p>
    <div class="nousContacter mt-2 mb-2">
      Vos coordonnées
    </div>
    <div class="desC1">
      <form class="row g-3" action="traitement_nous_contacter" method="post" >
        <div class="col-md-4">
          <select name="civilite" class="form-select" <?php  echo (isset($form_mail['civilite']) ? $form_mail['civilite'] : ''); ?> aria-label="Default select example">
            <option selected>Civilité </option>
            <option value="Madame">Madame</option>
            <option value="Monsieur">Monsieur</option>
          </select>
          <label for="validationCustomUsername" class="form-label">Civilité *</label>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" name="prenom" <?php  echo (isset($form_mail['prenom']) ? $form_mail['prenom'] : ''); ?> class="form-control" id="validationCustom01"  required />
            <label for="validationCustom01" class="form-label">Prénom *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" name="nom" value="<?php  echo (isset($form_mail['nom']) ? $form_mail['nom'] : ''); ?>" class="form-control" id="validationCustom02"  required />
            <label for="validationCustom02" class="form-label">Nom *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" name="ville" value="<?php  echo (isset($form_mail['ville']) ? $form_mail['ville'] : ''); ?>" class="form-control" id="validationCustom03" required />
            <label for="validationCustom03" class="form-label">Ville *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input onkeypress="return isNumber(event)" type="text" name="cp" value="<?php  echo (isset($form_mail['cp']) ? $form_mail['cp'] : ''); ?>" class="form-control" id="validationCustom05" required />
            <label for="validationCustom05" class="form-label">Code postal *</label>
          </div>
        </div>
        <div class="c2">
          <div class="nousContacter mb-2">
            Pour vous contacter
          </div>
          <div class="goldline2"></div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-outline">
                <input type="email" name="mail" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php  echo (isset($form_mail['mail']) ? $form_mail['mail'] : ''); ?>" required />
                <label for="validationCustomUsername" class="form-label">Adresse email *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" onkeypress="return isNumber(event)" name="numero" class="form-control" id="validationCustom05"  value="<?php  echo (isset($form_mail['numero']) ? $form_mail['numero'] : ''); ?>"  />
                <label for="validationCustom05" class="form-label">Téléphone mobile </label>
              </div>
            </div>
          </div>
        </div>
        <div class="c3">
          <div class="nousContacter mb-2">
            Message
          </div>
          <div class="mb-2">
            Sujet * :
          </div>
          <div class="col-md-4 mb-3">
            <div class="form-outline">
              <input type="text" class="form-control" id="validationCustom02" name="sujet" value="<?php echo isset($produit['nom_produit']) ? $produit['nom_produit'] : (isset($form_mail['sujet']) ? $form_mail['sujet'] : ''); ?>"  required />
            </div>
          </div>
          <div class="mb-2">
            Votre message * :
          </div>
          <div class="form-outline w-75 mb-4">
            <textarea id="exclude" name="message"  class="form-control" name="message" rows="3"><?php  echo (isset($form_mail['message']) ? $form_mail['message'] : ''); ?></textarea>
          </div>
        </div>
        <div class="g-recaptcha" data-sitekey="6Ldbt-4mAAAAAEWPw_sAQoCihnWo7w4Bq1o-zIAT"></div>
        <button type="submit" class="btn btn-primary adopterBtn2 mx-auto">
        Envoyer
        </button>
      </form>
    </div>
  </div>
</div>