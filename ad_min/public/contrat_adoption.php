<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

session_start();

if (!isset($_SESSION['idUserAdmin'])){
  header('Location:connexion');
  exit();
}

$idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
$adoption = getAdoptionFromChat($bdd,$idChat);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>pdf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  </head>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 12px;
    }
    input {
      height: 25px;
    }
    .badge img {
      width: 80px;
      height: auto;
    }
    .topText {
      font-size: 10px;
      font-style: italic;
    }
    .form-group {
      margin-top: 15px;
    }
    .bullet-point {
      position: relative;
      margin-top: 10px;
      gap: 20px;
    }

    .bullet-point::before {
      content: "•";
      position: absolute;
      left: -20px;
      font-size: 20px;
    }
    .form-control {
      border: none;
      background: transparent;
      font-size: 12px;
    }
    .testGap {
      gap: 10px;
    }
  </style>
  <body>
    <div class="container">
      <div class="row mt-3">
        <div class="col-12 text-center badge">
          <img src="public/assets/images/Logo-principal.jpg" alt="" />
        </div>
        <div class="col-12 text-center topText">
          Boite postale 42047 <br />
          57051 METZ CEDEX 2 <br />
          www.ecoleduchat.fr <br>
          Facebook : ecoleduchatmetz <br />
          N° de SIREN 89024047600014
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="mt-4 mb-3">Je soussigné(e) :</div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="name">Nom</label>
            <div class="col-8">
              <input type="text" class="form-control" value="<?php echo $adoption['nom']; ?>" id="name" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="prenom">Prénom</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['prenom']; ?>" class="form-control" id="prenom" placeholder=".........................................................................................." />
            </div>
          </div>


          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="date">Né(e) le</label>
            <div class="col-8">
                <input type="text" value="<?php echo $adoption['date_naissance'] !== NULL ? date('d-m-Y', strtotime($adoption['date_naissance'])) : ""; ?>" class="form-control" id="date" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="profession">Profession</label>
            <div class="col-8">
              <input type="text" class="form-control" id="profession" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="address">Adresse</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['adresse']; ?>" class="form-control" id="address" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="address">Ville & CP</label>
            <div class="col-8">
            <input type="text" value="<?php echo (!empty($adoption['nom_ville']) && !empty($adoption['cp'])) ? $adoption['nom_ville'].' '.$adoption['cp'] : ''; ?>"
 class="form-control" id="address" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="cardNumber">N° carte identité</label>
            <div class="col-8">
              <input type="text" class="form-control" id="cardNumber" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="telephone">Téléphone</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['numero']; ?>" class="form-control" id="telephone" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="email">Adresse mail</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['email']; ?>" class="form-control" id="email" placeholder=".........................................................................................." />
            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="mt-4 mb-3">Déclare ce jour, adopter le (la) chat(te)</div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="catName">Nom du chat(te)</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['nom_chat']; ?>" class="form-control" id="catName" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="sex">Sexe</label>
            <div class="col-8">
              <input type="text" value="<?php echo $adoption['sexe']; ?>" class="form-control" id="sex" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="color">Couleur</label>
            <div class="col-8">
              <input type="text" class="form-control" id="color" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="hairLength">Longueur du poil</label>
            <div class="col-8">
              <input type="text" class="form-control" id="hairLength" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="sign">Signe particulier</label>
            <div class="col-8">
              <input type="text" class="form-control" id="sign" placeholder=".........................................................................................." />
            </div>
          </div>

          <?php 
          if($adoption['age']!==NULL){
              $date = new DateTime($adoption['age']);
              $formattedDate = $date->format('d-m-Y');
          }else{
            $formattedDate = '';
          }
          ?>
          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="birthdate">Né(e) le</label>
            <div class="col-8">
              <input type="text" value="<?php echo $formattedDate; ?>" class="form-control" id="birthdate" placeholder=".........................................................................................." />
            </div>
          </div>

          <div class="form-group row d-flex align-items-center">
            <label class="col-4" for="icad">N° I-CAD</label>
            <div class="col-8">
              <input 
              type="text"
              class="form-control" 
              value="<?php 
              $formatted_identifiant = chunk_split($adoption['identifiant'], 2, ' ');
              echo trim($formatted_identifiant);
              ?>" 
              id="icad" 
              placeholder=".........................................................................................." />
            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
          <strong>M’engage à :</strong>
          <div>
            Assurer soins, affection et habitat, ne pas faire sortir la chatte (sécuriser fenêtres et balcon). <br />
            Prévenir l’association si je souhaite me séparer de l’animal, s’il s’échappe ou décède. <br />
            Donner des nouvelles de l’adoption de temps en temps. <br />
            En cas de mauvais traitement, de non-stérilisation de l’animal, l’association se réserve le droit de récupérer l’animal.
          </div>
          <div>Les frais d’adoptions comprennent :</div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <ul>
            <li class="d-flex bullet-point align-items-center">
              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="scales" name="scales" />
                <label for="scales">Primo vaccination (CTL) </label>
              </div>

              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="horns" name="horns" />
                <label for="horns">Rappel vaccination (CTL)</label>
              </div>
            </li>
            <li class="d-flex bullet-point align-items-center">
              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="scales" name="scales" />
                <label for="scales">Anti puces </label>
              </div>

              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="horns" name="horns" />
                <label for="horns">Vermifuge</label>
              </div>
            </li>
            <li class="d-flex bullet-point align-items-center">
              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="scales" name="scales" />
                <label for="scales">Stérilisation</label>
              </div>

              <div class="d-flex align-items-center testGap">
                <input type="checkbox" id="horns" name="horns" />
                <label for="horns">Castration âge adulte</label>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-12">Chèque nº :...........................de........................ € / Espèces : .........................................€</div>
      </div>
      <div class="row">
        <div class="col-12 text-end">
          Fait à : METZ, le ……………………….. <br />
          (Coordonnées Famille d’accueil) <br />
          <br />
          Nom : …………………………................ Prénom : …………...................................<br />
          <br />
          Adresse : ………………………......................................................... <br />
          Signature de l’adoptant et du membre de l’association <br />
          précédée de la mention « LU ET APPROUVÉ »
        </div>
      </div>
    </div>
    <script>
      window.onload = function () {
        window.print();
      };
    </script>
  </body>
</html>
