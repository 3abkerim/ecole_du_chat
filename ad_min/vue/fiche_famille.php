<?php
$idUser = isset($_GET['id']) ? intval($_GET['id']) : 0; 
$user = getUserById($bdd,$idUser);
$chats = getChatsSansFamilleAccueil($bdd);
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 h5 titlesFA">
        Informations personnelles
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mt-2">
            Civilité : <?php echo $user['civilite'] ?>
        </div>
        <div class="col-md-4 mt-2">
            Nom : <?php echo $user['nom'] ?>
        </div>
        <div class="col-md-4 mt-2">
            Prénom : <?php echo $user['prenom'] ?>
        </div>
        <div class="col-md-4 mt-2">
            Date de naissance : <?php echo date("d-m-Y",strtotime($user['date_naissance']));  ?>
        </div>
        <div class="col-md-4 mt-2">
            Numéro de téléphone  : <?php echo $user['numero'] ?>
        </div>
        <div class="col-md-4 mt-2">
            email : <?php echo $user['email'] ?>
        </div>
    </div>

    <div class="mt-5 d-flex align-items-center">
        <div class="h5 titlesFA d-flex align-items-center">
            Ajouter un chat
        </div>
        <?php if (isset($_SESSION['error_fa'])): ?>
        <div class="errorFa d-flex align-items-center">
            <?= $_SESSION['error_fa'] ?>
        </div>
        <?php unset($_SESSION['error_fa']);  ?>
        <?php endif; ?>

    </div>

    <form action="traitement_chat_user_fa" method="post">



        <input type="hidden" value="<?php echo $idUser ?>" name="idUser">
        <div class="row mt-2">
            <div class="col-4">
                <select type="" class="form-select" id="chat" name="idChat" >
                    <option selected disabled>Chats</option>
                    <?php
                    foreach ($chats as $chat){ 
                    ?>
                    <option value="<?php echo $chat['id_chat'];?>"><?php echo $chat['nom_chat'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-2 d-flex align-items-center">
                <button type="submit" class="btnAjout"><img src="public/assets/images/plus.png" alt=""></button>
            </div>
        </div>
    </form>

    <div class="mt-5 d-flex align-items-center">
        <div class="h5 titlesFA d-flex align-items-center">
            Chats en accueil
        </div>
        <?php if (isset($_SESSION['sucessFa'])): ?>
        <div class="sucessFa d-flex align-items-center">
            <?= $_SESSION['sucessFa'] ?>
        </div>
        <?php unset($_SESSION['sucessFa']);  ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_fa_2'])): ?>
        <div class="sucessFa d-flex align-items-center">
            <?= $_SESSION['success_fa_2'] ?>
        </div>
        <?php unset($_SESSION['success_fa_2']);  ?>
        <?php endif; ?>

    </div>

    <div class="row mb-5">
        <div class="col-md-12 tableau mt-3 bg-light mx-auto">
            <table class="table table-hover bg-light mt-2">
            <tr class="titreTable bg-light text-center">
                <th>#</th>
                <th>Nom chat</th>
                <th>Date début accueil</th>
                <th>Date fin accueil</th>
                <th>Mettre à jour</th>
                <th>Supprimer</th>
            </tr>
            <?php 
            $chats = getChatEnAccueilUser($bdd,$idUser);
            foreach ($chats as $indice => $chat){ 
                $indice++; 
            ?>
            <form action="traitement_update_fa" method="post">

            <tr>
                <td><?php echo $indice; ?></td>

                <td class="ellipsis"><?php echo $chat['nom_chat'] ?></td>



                <?php 
                if (!isset($chat['date_start']) || empty($chat['date_start'])) { 
                ?>
                <td><input name='date_start' type='date'></td>
                <?php } else {
                $date_start = DateTime::createFromFormat('Y-m-d', $chat['date_start']);
                ?>
                <td class="ellipsis"> <input type="date" name="date_start" value="<?php echo $date_start->format('Y-m-d')?>"></td>
                <?php } ?>
                
                

                <?php 
                if (!isset($chat['date_end']) || empty($chat['date_end'])) { 
                ?>
                <td><input name='date_end' type='date'></td>
                <?php } else {
                $date_start = DateTime::createFromFormat('Y-m-d', $chat['date_end']);
                ?>
                <td class="ellipsis"> <input type="date" name="date_end" value="<?php echo $date_start->format('Y-m-d')?>"></td>
                <?php } ?>


                <input type="hidden" name="idChat" value="<?php echo $chat['id_chat']; ?>">
                <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">


                <td class="ellipsis demandes">
                    <button type="submit" class="refresh"><img class="btns" src="public/assets/images/refresh.png" alt="" /></button>
                </td>

                <td class="ellipsis demandes">
                    <a class="p-2" href="traitement_supprimer_chat_en_accueil-<?php echo $chat['id_chat']; ?>-<?php echo $idUser; ?>"><img class="btns" src="public/assets/images/dump.png" alt="" /></a>
                </td>
            </tr>
            </form>
            <?php } ?>

            </table>
        </div>
    </div>


</div>

