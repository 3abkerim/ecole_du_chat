<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require '../modele/connexion_pdo.php';
  require '../modele/fonctions.php';

//   file_put_contents('php://stderr', print_r($_POST, TRUE));

  $gender = $_POST['gender'];
  $age = $_POST['age'];

  // Define your filter conditions
  $genderCondition = $gender === 'any' ? '1' : ($gender === 'male' ? 'sexe_id_sexe = 1' : 'sexe_id_sexe = 2');
  $ageCondition = $age === 'any' ? '1' : ($age === 'kitten' ? 'age >= DATE_SUB(NOW(), INTERVAL 1 YEAR)' : 'age < DATE_SUB(NOW(), INTERVAL 1 YEAR)');

  // Query the database with the filters
  $req = "
  SELECT *
  FROM chats c
  LEFT JOIN adoption a ON a.chats_id_chat = c.id_chat
  JOIN sexe s ON c.sexe_id_sexe = s.id_sexe 
  WHERE $genderCondition AND $ageCondition AND en_ligne = 1 AND supprime = 0 AND decede = 0 AND a.chats_id_chat IS NULL
  ";
  $chats = $bdd->query($req)->fetchAll();
//   var_dump($chats);


if (count($chats) == 0) {
    include '../vue/chats_indisponible.php';
} else {
    foreach ($chats as $chat) {
        require '../vue/card_chats.php';
    }
}

// At the end, you need to close the section which you opened here
}
?>
