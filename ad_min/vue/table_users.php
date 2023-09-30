
      <tr>
        <td><?php echo $indice; ?></td>

        <td class="ellipsis"><?php echo $user['prenom']; ?></td>

        <td class="ellipsis"><?php echo $user['nom']; ?></td>

        <td class="ellipsis"><?php echo $user['email']; ?></td>

        <td class="ellipsis"><?php echo $user['numero']; ?></td>

        <td><?php echo $user['role']; ?></td>


        <td>
            <a class="p-2" href="users-<?php echo $user['id_user']; ?>"><img class="btns" src="public/assets/images/file.png" alt="" /></a>
        </td>

      </tr>
