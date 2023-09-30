
      <tr>
        <td><?php echo $indice; ?></td>

        <td class="ellipsis">
            <?php echo $demande['id_fa']; ?>
        </td>

        <td class="ellipsis">
            <?php echo $demande['prenom']; ?>
        </td>

        <td class="ellipsis">
            <?php echo $demande['nom']; ?>
        </td>

        <td>
            <?php 
            $date_produit = DateTime::createFromFormat('Y-m-d H:i:s', $demande['date_form']);
            echo $date_produit ? $date_produit->format('d-m-Y H:i') : $demande['date_form'];
            ?>
        </td>

        <td class="ellipsis imgForm">
            <a href="fiche_demande_fa-<?php echo $demande['id_fa']; ?>">
                <img class="imgForm" src="public/assets/images/google-forms.png" alt="">
            </a>
        </td>


      </tr>
