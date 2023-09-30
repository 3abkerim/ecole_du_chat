

<tr>
        <td><?php echo $indice; ?></td>

        <!-- IMAGES -->

        <?php 
        $images = getImagesChat($bdd, $chat['id_chat']);
        if (count($images) > 0) { 
          $firstImage = $images[0]['fichier']; 
        ?>
        <td>
          <img class="imgTable" src="<?php echo $firstImage; ?>" />
        </td>
        <?php } else { ?>
        <td>
          <span>No image</span>
        </td>
        <?php } ?>

        <td><?php echo $chat['nom_chat']; ?></td>
        <td><?php echo $chat['id_chat']; ?></td>
        <td><?php echo $chat['sexe']; ?></td>


        <td>
          <a class="p-2" href="fiche_chat-<?php echo $chat['id_chat']; ?>"><img class="btns" src="public/assets/images/edit.png" alt="" /></a>

          <div class="supprimer">
                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $chat['id_chat'];?>" > <img src="public/assets/images/dump.png" alt=""> </div>
                <div class="modal fade" id="deleteModal<?php echo $chat['id_chat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer les données de <?php echo $chat['nom_chat']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                                <a class="p-2 btnModal" href="supprimer_chat-<?php echo $chat['id_chat']; ?>">oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </td>

        <td>
          <a class="p-2" href="saisie_photos_chat-<?php echo $chat['id_chat']; ?>"><img class="btns" src="public/assets/images/image.png" alt="" /></a>
        </td>


        <td class="text-center">
          <div class="d-flex justify-content-center">
          <div class="form-check form-switch mx-auto">
            <input disabled class="form-check-input" type="checkbox" role="switch" data-type="chat" id="flexSwitchCheckDefault_<?php echo $chat['id_chat']; ?>" data-id="<?php echo $chat['id_chat']; ?>" <?php echo $chat['en_ligne'] == 1 ? 'checked' : ''; ?>  >
            <!-- <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label> -->
          </div>
          </div>
        </td>

      </tr>
