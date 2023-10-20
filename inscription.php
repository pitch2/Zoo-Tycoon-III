<?php
// Chemin vers le fichier JSON
$chemin_fichier_json = 'login.json';

// Lire le contenu du fichier JSON
$contenu_fichier = file_get_contents($chemin_fichier_json);

// Décoder le contenu en un tableau associatif
$data = json_decode($contenu_fichier, true);

if ($data === null) {
    die('Erreur lors de la lecture du fichier JSON');
}

if (isset($_GET['submit'])) { // Vérifier si le formulaire a été soumis
    // Récupération des saisies du formulaire
    $email = $_GET['email'];
    $password = $_GET['password'];

    // Ajouter le nouvel utilisateur au tableau "utilisateurs"
    $data['utilisateurs'][] = array(
        'email' => $email,
        'password' => $password,
    );

    // Réencoder les données en JSON
    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    // Vérifier les erreurs d'encodage JSON
    if ($json_data === false) {
        die('Erreur lors de l\'encodage JSON');
    }

    // Écrire les données encodées dans le fichier
    file_put_contents($chemin_fichier_json, $json_data);
}


// ecriture dans long
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

// Récupérer le timestamp actuel
$timestamp = time() + 3600*2; // Ajouter 1 heure en secondes pour UTC+1

// Formatter la date et l'heure avec le nouveau timestamp
$date = strftime('%d-%m-%Y %H:%M:%S', $timestamp);

// Lire le contenu du fichier JSON existant pour long.json
$file_content_long = file_get_contents('long.json');

// Décoder le contenu JSON en un tableau PHP
$data_long = json_decode($file_content_long, true);

// Vérifier si le décodage a réussi
if ($data_long === null) {
    die('Erreur lors de la lecture du fichier JSON (long)');
}

// Ajouter le nouvel utilisateur au tableau "utilisateurs" dans long.json
$data_long['utilisateurs'][] = array(
    'email' => $email,
    'password' => $password,
    'heure' => $date
);

// Réencoder les données en JSON
$json_data_long = json_encode($data_long, JSON_PRETTY_PRINT);

// Vérifier les erreurs d'encodage JSON
if ($json_data_long === false) {
    die('Erreur lors de l\'encodage JSON (long)');
}

// Écrire les données encodées dans le fichier long.json
file_put_contents('long.json', $json_data_long);
?>
