<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request and decode it from JSON to PHP array
    $data = json_decode(file_get_contents('php://input'), true);

    // Iterate over each item in the data
    foreach ($data as $item) {
        // Prepare an SQL UPDATE query
        $query = 'UPDATE images SET ordre = :ordre WHERE id_image = :id';
        $statement = $bdd->prepare($query);

        // Bind parameters and execute the query
        $statement->bindValue(':ordre', $item['order'], PDO::PARAM_INT);
        $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);
        if ($statement->execute()) {
            echo "Successfully updated image with ID: " . $item['id'] . " to order: " . $item['order'] . "\n";
        } else {
            echo "Error updating image with ID: " . $item['id'] . "\n";
            print_r($statement->errorInfo());
        }
    }

    echo "Image order updated successfully.";
} else {
    echo "No data received.";
}
?>
