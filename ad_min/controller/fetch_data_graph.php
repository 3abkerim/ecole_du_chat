<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

function getAdoptionParMois($bdd, $year, $month)
{
    $req = $bdd->prepare('SELECT COUNT(*) AS count FROM adoption WHERE YEAR(date_adoption) = :year AND MONTH(date_adoption) = :month');
    $req->execute([':year' => $year, ':month' => $month]);
    $res = $req->fetch();
    return $res['count'];
}

// Get the current year
$currentYear = date('Y');

// Prepare the data for the response
$labels = [
  "Janvier ", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"
];
$adoptionData = [];

// Get the adoption count for each month of the current year
foreach ($labels as $index => $label) {
  $count = getAdoptionParMois($bdd, $currentYear, $index + 1);
  array_push($adoptionData, $count);
}

// Prepare the response as JSON
$response = [
  'labels' => $labels,
  'adoptionData' => $adoptionData
];

header('Content-Type: application/json');
echo json_encode($response);
?>
