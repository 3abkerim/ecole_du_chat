
      <tr>
        <td><?php echo $indice; ?></td>

        <td><?php echo $event['event']; ?></td>
        <td>
            <?php 
            $date_event = DateTime::createFromFormat('Y-m-d H:i:s', $event['date_event']);
            echo $date_event ? $date_event->format('d-m-Y H:i') : $event['date_event'];
            ?>
        </td>

        <td>
            <?php 
            $date_fin_event = DateTime::createFromFormat('Y-m-d H:i:s', $event['date_fin_event']);
            echo $date_fin_event ? $date_fin_event->format('d-m-Y H:i') : $event['date_fin_event'];
            ?>
        </td>

        <td>
            <?php 
            $date_publication = DateTime::createFromFormat('Y-m-d H:i:s', $event['date_publication']);
            echo $date_publication ? $date_publication->format('d-m-Y H:i') : $event['date_publication'];
            ?>
        </td>




        <td>
          <a class="p-2" href="fiche_event-<?php echo $event['id_event']; ?>"><img class="btns" src="public/assets/images/edit.png" alt="" /></a>

          <div class="supprimer">
                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $event['id_event'];?>" > <img src="public/assets/images/dump.png" alt=""> </div>
                <div class="modal fade" id="deleteModal<?php echo $event['id_event']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer l'évènement <?php echo $event['id_event']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                                <div class="btnModal d-flex align-items-center justify-content-center">
                                  <a href="traitement_supprimer_event-<?php echo $event['id_event']; ?>">oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </td>

        <td>
          <a class="p-2" href="affiche_event-<?php echo $event['id_event']; ?>"><img class="btns" src="public/assets/images/image.png" alt="" /></a>
        </td>




        <td class="text-center">
          <div class="d-flex justify-content-center">
          <div class="form-check form-switch mx-auto">
            <input class="form-check-input" type="checkbox" role="switch" data-type="event" id="flexSwitchCheckDefault_<?php echo $event['id_event']; ?>" data-idEvent="<?php echo $event['id_event']; ?>" <?php echo $event['en_ligne'] == 1 ? 'checked' : ''; ?>  >
            <!-- <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label> -->
          </div>
          </div>
        </td>

      </tr>
