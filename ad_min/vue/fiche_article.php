<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$idArticle = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article = getArticleById($bdd, $idArticle);
$user = getUserById($bdd,$article['users_id_user']);
?>


  <form action="traitement_modif_article" method="post">
    <input name="id_article" value="<?php echo $idArticle; ?>" type="hidden">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_6'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_6'] ?>
  </div>
  <?php unset($_SESSION['error_6']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_6'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_6'] ?>
  </div>
  <?php unset($_SESSION['success_6']);  ?>
  <?php endif; ?>

    <div class="col-lg-12">
      <div class="mb-3 row">
        <label for="titre_article" class="col-sm-6 col-form-label">Titre article *</label>
        <div class="col-sm-12">
          <input type="title" name="titre_article" class="form-control" id="titre_article" placeholder="Titre article" value="<?php echo isset($article['titre_article']) ? htmlspecialchars($article['titre_article']) : '' ?>" require />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="article" class="col-sm-6 col-form-label">Article *</label>
        <div class="col-sm-12">
          <textarea name="article" id="article" class="form-control" id="#" rows="8"><?php echo isset($article['article']) ? htmlspecialchars($article['article']) : '' ?></textarea>
        </div>
      </div>

      <?php
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $article['date_article']);
      ?>
      <div class="mb-3 row">
        <div class="col-12">
            Article publié par <?php echo $user['prenom']; echo ' '; echo $user['nom']; ?> le <?php echo $date->format('d-m-Y H:i:s'); ?>
        </div>
      </div>

    </div>


    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Mettre à jour</button>
    </div>
  </div>
</form>