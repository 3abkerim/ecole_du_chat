
<tr>
    <td><?php echo $indice; ?></td>
    <!-- IMAGES -->

    <td>
        <?php echo $adoption['id_chat'] ?>
    </td>

    <td><?php echo $adoption['nom_chat']; ?></td>
    <td><?php echo $adoption['prenom']; echo ' '; echo $adoption['nom']; ?></td>
    
    <td><?php echo date('d-m-Y', strtotime($adoption['date_adoption'])); ?></td>







    <td>
        <a target="_blank" class="p-2" href="contrat-<?php echo $adoption['id_chat']; ?>"><img class="btns" src="public/assets/images/book.png" alt="" /></a>
    </td>

    <td>
        <div class="supprimer">
            <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $adoption['id_chat'];?>" > <img src="public/assets/images/dump.png" alt=""> </div>
            <div class="modal fade" id="deleteModal<?php echo $adoption['id_chat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir terminer l'adoption de <?php echo $adoption['nom_chat']; ?> et de retourner le chat à la liste des chats disponibles?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                        <div class="btnModal d-flex align-items-center justify-content-center">
                            <a href="traitement_supprimer_adoption-<?php echo $adoption['id_chat']; ?>">oui</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </td>

    </tr>
