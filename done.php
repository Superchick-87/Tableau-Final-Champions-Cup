<?php
// Récupérer les données depuis $_POST
$data = array(
    "Quart de finale 1" => array(
        $_POST['lieu_qf1'],
        $_POST['team1_qf1'],
        $_POST['score1_qf1'],
        $_POST['team2_qf1'],
        $_POST['score2_qf1']
    ),
    "Quart de finale 2" => array(
        $_POST['lieu_qf2'],
        $_POST['team1_qf2'],
        $_POST['score1_qf2'],
        $_POST['team2_qf2'],
        $_POST['score2_qf2']
    ),
    "Quart de finale 3" => array(
        $_POST['lieu_qf3'],
        $_POST['team1_qf3'],
        $_POST['score1_qf3'],
        $_POST['team2_qf3'],
        $_POST['score2_qf3']
    ),
    "Quart de finale 4" => array(
        $_POST['lieu_qf4'],
        $_POST['team1_qf4'],
        $_POST['score1_qf4'],
        $_POST['team2_qf4'],
        $_POST['score2_qf4']
    ),
    "Demi-finale 1" => array(
        $_POST['lieu_sf1'],
        $_POST['team1_sf1'],
        $_POST['score1_sf1'],
        $_POST['team2_sf1'],
        $_POST['score2_sf1']
    ),
    "Demi-finale 2" => array(
        $_POST['lieu_sf2'],
        $_POST['team1_sf2'],
        $_POST['score1_sf2'],
        $_POST['team2_sf2'],
        $_POST['score2_sf2']
    ),
    "Finale" => array(
        $_POST['lieu_final'],
        $_POST['team1_final'],
        $_POST['score1_final'],
        $_POST['team2_final'],
        $_POST['score2_final']
    )
);

// Ouvrir ou créer le fichier CSV en mode écriture
$file = fopen('datas.csv', 'w');

// Parcourir chaque élément du tableau et écrire dans le fichier CSV
foreach ($data as $key => $value) {
    fputcsv($file, array_merge(array($key), $value));
}

// Fermer le fichier
fclose($file);

// Réponse indiquant que les données ont été écrites avec succès dans le fichier CSV
echo "Les données ont été enregistrées dans le fichier CSV avec succès.";
?>

