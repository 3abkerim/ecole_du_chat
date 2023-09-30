<?php
if (!isset($_SESSION['idUserAdmin'])){
    header('Location:connexion');
    exit();
  }

$chats = countChatsEnLigne($bdd);
$formsFa = countFormsFA($bdd);
$formsAd = countFormsAD($bdd);
?>

<div class="container navTest">
    <div class="row ">
        <div class="col-12">
            <div class="titreGestion mt-3">
                Tableau de bord
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">

        <div class="col-lg-5">
            <canvas id="adoptionChart"></canvas>
        </div>

        <div onclick="window.location.href='gestion_chats'" class="col-lg-5 offset-lg-1 bubbles d-flex flex-column justify-content-center align-items-center">
            <div></div>
            <div class="numberTB"><?php echo $chats['number']; ?> Chats</div>
            <div class="enLigne">En ligne</div>
        </div>

    </div>


    <div class="row d-flex justify-content-center">

        <div onclick="window.location.href='adoptions'" class="col-lg-5 bubbles d-flex flex-column justify-content-center align-items-center">
            <div class="numberTB"><?php echo $formsAd['number_ad']; ?></div>
            <div class="demandesTB text-center">Demandes d'adoption</div>
        </div>

        <div onclick="window.location.href='demandes_familles_accueil'" class="col-lg-5 offset-lg-1 bubbles d-flex flex-column justify-content-center align-items-center">
            <div class="numberTB"><?php echo $formsFa['number_fa']; ?></div>
            <div class="demandesTB text-center">Demandes FA</div>
        </div>

    </div>
</div>


