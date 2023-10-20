<?php
// Chemin vers le fichier JSON
$chemin_fichier_json = 'login.json';

// Lire le contenu du fichier JSON
$contenu_fichier = file_get_contents($chemin_fichier_json);

// Décoder le contenu en un tableau associatif
$tableau_associatif = json_decode($contenu_fichier, true);

if (isset($_GET['submit'])) { // Vérifier si le formulaire a été soumis
    // Récupération des saisies du formulaire
    $email = $_GET['email'];
    $password = $_GET['password'];

    // Élément que vous souhaitez vérifier
    $element_recherche = array(
        "email" => $email,
        "password" => $password
    );

    $element_trouve = false;

    // Vérifier la présence de l'élément dans le tableau
    if ($tableau_associatif && is_array($tableau_associatif['utilisateurs'])) {
        foreach ($tableau_associatif['utilisateurs'] as $utilisateur) {
            if ($utilisateur['email'] === $email && $utilisateur['password'] === $password) {
                $element_trouve = true;
                break;
            }
        }
    }

    // Afficher le résultat de l'identification
    if ($element_trouve) {
        echo "Identification validée";
    } else {
        echo "L'identification a échoué, votre mail ou mots de passe est mauvais";
    }
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

    // Récupérer le timestamp actuel
    $timestamp = time() + 3600*2; // Ajouter 1 heure en secondes pour UTC+1

    // Formatter la date et l'heure avec le nouveau timestamp
    $date = strftime('%d-%m-%Y %H:%M:%S', $timestamp);


    // Lire le contenu du fichier JSON existant
    $file_content = file_get_contents('long.json');

    // Décoder le contenu JSON en un tableau PHP
    $data = json_decode($file_content, true);

    // Vérifier si le décodage a réussi
    if ($data === null) {
        die('Erreur lors de la lecture du fichier JSON');
    }

    // Ajouter le nouvel utilisateur au tableau "utilisateurs"
    $data['utilisateurs'][] = array(
        'email' => $email,
        'password' => $password,
        'heure' => $date
    );

    // Réencoder les données en JSON
    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    // Vérifier les erreurs d'encodage JSON
    if ($json_data === false) {
        die('Erreur lors de l\'encodage JSON');
    }

    // Écrire les données encodées dans le fichier
    file_put_contents('long.json', $json_data);

}    
    
?>
