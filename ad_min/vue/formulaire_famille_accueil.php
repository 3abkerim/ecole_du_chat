<?php 
$idForm = isset($_GET['idForm']) ? intval($_GET['idForm']) : 0;
$form = getRequestsForFosterById($bdd,$idForm);
?>




<div class="container mainContact2">
  <div class="row mt-5">
    <div class="col-12 text-center display-8 nosChats">Questionnaire famille d'accueil</div>
    <div class="col-12 text-center displat-8">Réference nº<?php echo $form['id_fa']; ?></div>
  </div>

  <!-- <div class="progress mb-3 mt-3">
    <div class="progress-bar w-25 Pbar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
  </div> -->

    <!-- Section 1 : Informations personnelles -->

    <div class="mt-3 container">
      <div class="row">
        <div class="col-12 text-center titresForm">1. Informations personnelles</div>
      </div>

      <div class="row g-3 mt-3">
        <div class="col-md-4">
          <input type="text" class="form-control" value="<?php echo $form['civilite']; ?>" readonly>
          <label for="validationCustom01" class="form-label">Civilité *</label>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly type="text" class="form-control" id="validationCustom02" name="prenom" required value="<?php echo isset($form['prenom']) ? $form['prenom'] : (isset($form['prenom']) ? $form['prenom'] : ''); ?>"/>
            <label for="validationCustom01" class="form-label">Prénom *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly type="text" class="form-control" id="validationCustom02" name="nom" required value="<?php echo isset($form['nom']) ? $form['nom'] : (isset($form['nom']) ? $form['nom'] : ''); ?>"/>
            <label for="validationCustom02" class="form-label">Nom *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="adresse" required value="<?php echo isset($form['adresse']) ? $form['adresse'] : (isset($form['adresse']) ? $form['adresse'] : ''); ?>"/>
            <label for="validationCustomUsername" class="form-label">Adresse *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" class="form-control" value="<?php echo $form['nom_departement']; ?>" readonly>
            <label for="validationCustom03" class="form-label">Département</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" class="form-control" value="<?php echo $form['nom_ville']; ?>" readonly>
            <label for="ville" class="form-label">Ville</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-outline">
            <input value="<?php echo isset($form['email']) ? $form['email'] : (isset($form['email']) ? $form['email'] : ''); ?>" type="mail" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="mail" required />
            <label for="validationCustomUsername" class="form-label">Adresse email *</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly value="<?php echo isset($form['numero']) ? $form['numero'] : (isset($form['numero']) ? $form['numero'] : ''); ?>"  type="text" class="form-control" id="validationCustom05" name="tel" />
            <label for="validationCustom05" class="form-label">Téléphone mobile</label>
          </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-outline">
                <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($form['date_naissance'])); ?>" readonly>
                <label for="validationCustom05" class="form-label">Date naissance *</label>
            </div>
        </div>


        <div class="col-md-4">
          <input id="statut" type="text" class="form-control" value="<?php echo $form['statut']; ?>" readonly>
          <label for="statut" class="form-label">Statut</label>
        </div>

        <div class="col-md-4">
          <input id="situation" type="text" class="form-control" value="<?php echo $form['situation']; ?>" readonly>
          <label for="situation" class="form-label">Situation</label>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <div class="form-outline">Vous avez des enfants? :</div>
        </div>
        <div class="col-md-4 mb-2">
          <input type="text" class="form-control" value="<?php echo $form['enfants']; ?>" readonly>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly value="<?php echo $form['age_enfants']; ?>" type="text" class="form-control" id="validationCustom05" name="ageEnfants" />
            <label for="validationCustom05" class="form-label">Ages</label>
          </div>
        </div>
      </div>

    </div>

    <!-- ! FIN Section 1 : Informations personnelles -->

    <!-- Section 2 : Situation de logement -->

    <div id="step2">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">2. Situation de logement</div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Vous habitez en :</div>
        </div>
        <div class="col-md-4">
          <input id="situation" type="text" class="form-control" value="<?php echo $form['type']; ?>" readonly>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Pièces du logement :</div>
        </div>
        <div class="col-md-4">
          <input id="pieces" type="text" class="form-control" value="<?php echo $form['taille']; ?>" readonly>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Superficie du logement :</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input readonly value="<?php echo (isset($form['superficie_logement']) ? $form['superficie_logement'] : ''); ?>" type="number" class="form-control" id="validationCustom05" name="superficie_logement" />
            <label for="validationCustom05" class="form-label">en m²</label>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si vous avec un balcon ou terrasse, le chat y aura-t’il accès ?</div>
        </div>
        <div class="col-md-4">
          <?php
          if (isset($form['acces_balcon']) && $form['acces_balcon'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>


      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Votre balcon est il sécurisé ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['is_balcon_secure']) && $form['is_balcon_secure'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si votre balcon n’est pas sécurisé, êtes vous prêt à le faire ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['faire_securite_balcon']) && $form['faire_securite_balcon'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si oui de quelle façon ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="how_secure_balcon" class="form-control" id="desc" rows="3"><?php echo (isset($form['dtls_securite_balcon']) ? $form['dtls_securite_balcon'] : ''); ?></textarea>
          </div>
        </div>
      </div>
      

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Habitez-vous à proximité d’une route avec beaucoup de circulation ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['route_proche']) && $form['route_proche'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si vous êtes locataires, avez-vous la permission d’avoir un animal ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['vehicule']) && $form['vehicule'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>
    </div>

    <!--! FIN Section 2 : Situation de logement -->

    <!-- Section 3 : Accueil de l'animal -->

    <div id="step3">

      <div class="row mt-5">
        <div class="col-12 text-center titresForm">3. Accueil du chat</div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Etes-vous véhiculé(e) ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['vehicule']) && $form['vehicule'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Tous les membres du foyer sont-ils d’accord pour l’accueil d’un chat ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['accord']) && $form['accord'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Un des membres de votre famille souffre-t’il d’allergies ou d’asthme ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['asthme']) && $form['asthme'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">vos enfants ont-ils eu des contacts avec des chats ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['enfants_contacts']) && $form['enfants_contacts'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">si vous n’avez pas d’enfant et que vous prévoyez d’en avoir, cela vous semble t’il compatible avec la présence d’un chat ? (hygiène, toxoplasmose et allergie du chat disponibilité ...).</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['compatible']) && $form['compatible'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>
    </div>

    <!-- !FIN Section 3 : Accueil de l'animal -->

    <!-- Section 4 : Expérience avec les animaux -->

    <div id="step4">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">4. Expérience avec les animaux</div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Avez-vous déjà eu des animaux ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['avoir_animal']) && $form['avoir_animal'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Lesquels ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="desciptionAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form['dtls_animaux']) ? $form['dtls_animaux'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Quels sont les nuisances ou dégâts éventuels causés par un chat ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="nuisances" class="form-control" id="desc" rows="3"><?php  echo (isset($form['degats_chat']) ? $form['degats_chat'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Combien possédez-vous d’animaux actuellement ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="combienAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form['animaux_possedes']) ? $form['animaux_possedes'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">De quelle(s) espèces sont(ils) ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="especes" class="form-control" id="desc" rows="3"><?php  echo (isset($form['especes']) ? $form['especes'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Quel(s) sexe(s) ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="sexeAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form['sexe']) ? $form['sexe'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Sont-ils stérilisés ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['sterlises']) && $form['sterlises'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Que pensez-vous de la stérilisation / castration ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="sterilisation" class="form-control" id="desc" rows="3"><?php  echo (isset($form['avis_sterlisation']) ? $form['avis_sterlisation'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Leurs vaccins sont ils à jour ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['vaccins_ajour']) && $form['vaccins_ajour'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Nom et coordonnées de la clinique vétérinaire référente</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="cliniques" class="form-control" id="desc" rows="3"><?php  echo (isset($form['veto_referant']) ? $form['veto_referant'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Avez-vous déjà adopté un animal (par le biais d’un refuge ou association) ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['deja_adopte_animal']) && $form['deja_adopte_animal'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Pouvez-vous partager avec nous votre expérience, si vous en avez, dans la prise en charge des chatons ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="cliniques" class="form-control" id="desc" rows="3"><?php  echo (isset($form['chaton']) ? $form['chaton'] : ''); ?></textarea>
          </div>
        </div>
      </div>

    </div>
    <!-- ! FIN Section 4 : Expérience avec les animaux -->

    <!-- Section 5 : Antécédents avec les animaux -->

    <div id="step5">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">5. Antécédents avec les animaux</div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si jamais celui-ci est décédé, pouvez-vous nous indiquer la raison et son âge ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="raison_decedes" class="form-control" id="desc" rows="3"><?php  echo (isset($form['raison_decedes']) ? $form['raison_decedes'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Avez-vous dû vous séparer d’un animal par le passé ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['separation_animal']) && $form['separation_animal'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Si oui pour quelle raison ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="raison_separation" class="form-control" id="desc" rows="3"><?php  echo (isset($form['raison_separation']) ? $form['raison_separation'] : ''); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- ! FIN Section 5 : Antécédents avec les animaux -->

    <!-- Section 6 : Préparation pour l'adoption -->

    <div id="step6">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">6. Préparation pour l'adoption</div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Combien d’heures par jour le chat restera-t’il seul ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <input readonly name="heuresSeul" class="form-control" type="number" value="<?php  echo (isset($form['chat_seul_heures']) ? $form['chat_seul_heures'] : ''); ?>" />
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Comment envisagez-vous de gérer une éventuelle cohabitation avec d'autres animaux à la maison ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="nourriture" class="form-control" id="desc" rows="3"><?php  echo (isset($form['cohabitation']) ? $form['cohabitation'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Avez-vous une pièce calme où le chat peut s'installer et se sentir en sécurité lorsqu'il arrive pour la première fois?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['installation']) && $form['installation'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>

        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Pouvez-vous décrire la routine quotidienne de votre maison?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly class="form-control"  id="" cols="30" rows="10"><?php  echo (isset($form['routine']) ? $form['routine'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Lorsque vous vous absentez (week-ends, vacances), avez-vous un mode de garde ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="garde" class="form-control" id="desc" rows="3"><?php  echo (isset($form['absence']) ? $form['absence'] : ''); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- ! FIN Section 6 : Préparation pour l'adoption -->

    <!-- Section 7 : Motivation et attentes -->

    <div id="step7">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">7. Motivation et attentes</div>
      </div>

      <div class="row mt-5 mb-5">
        <div class="col-md-4">
          <div class="form-outline">Avez-vous déjà eu l'expérience d'être une famille d'accueil pour un animal auparavant ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['experience']) && $form['experience'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Pour quelles raisons souhaitez-vous devenir famille d'accueil pour un chat ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="raisonAdopter" class="form-control" id="desc" rows="3"><?php  echo (isset($form['raisonAccueil']) ? $form['raisonAccueil'] : ''); ?></textarea>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4">
          <div class="form-outline">Comment géreriez-vous les situations difficiles liées au comportement d'un chat ?</div>
        </div>
        <div class="col-md-4">
          <div class="form-outline w-75 mb-4">
            <textarea readonly name="raisonCeChat" class="form-control" id="desc" rows="3"><?php  echo (isset($form['comportement']) ? $form['comportement'] : ''); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <!--! FIN Section 7 : Motivation et attentes -->

    <!-- Section 8 : Engagement -->

    <div id="step8">
      <div class="row mt-5">
        <div class="col-12 text-center titresForm">8. Engagement</div>
      </div>

      <div class="row mt-5 mb-5">
        <div class="col-md-4">
          <div class="form-outline">Si le chat a des besoins médicaux spécifiques, êtes-vous prêt à administrer des médicaments ou à emmener le chat chez le vétérinaire ?</div>
        </div>
        <div class="col-md-4">
        <?php
          if (isset($form['medicament']) && $form['medicament'] == 1) {
            echo "oui";
        } else {
            echo "non";
        }
        
          ?>
        </div>
      </div>


    </div>
    <!-- ! FIN Section 8 : Engagement -->


    <div class="row mt-4 mb-5 d-flex justify-content-around">
      <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_2" class="col-6 btn btn-primary formAdoptBtnRed" >
        Refuser
      </button>
      <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_1" class="col-6 btn btn-primary formAdoptBtn">
        Valider
      </button>
  </div>

<!-- Modal 1 -->
<div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Acceptez-vous que <?php echo $form['civilite']; echo ' '; echo $form['prenom']; echo ' '; echo $form['nom']; ?> devient une famille d'accueil à l'école du chat?
      </div>
      <div class="modal-footer modalFA">
        <button type="button" class="btnModal2" data-bs-dismiss="modal">Fermer</button>
        <div class="btnModal d-flex align-items-center justify-content-center">
          <a href="traitement_valider_fa-<?php echo $idForm;?>">Oui</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Êts-vous sure de bien refuser la demande de <?php echo $form['civilite']; echo ' '; echo $form['prenom']; echo ' '; echo $form['nom']; ?> pour devenir une famille d'accueil à l'école du chat?
      </div>
      <div class="modal-footer modalFA">
        <button type="button" class="btnModal2" data-bs-dismiss="modal">Fermer</button>
        <div class="btnModal d-flex align-items-center justify-content-center">
          <a href="traitement_supprimer_demande_fa-<?php echo $idForm;?>">Oui</a>
        </div>
      </div>
    </div>
  </div>
</div>



</div>

