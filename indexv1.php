<?php
// Fonction utilitaire pour charger un fichier JSON de recette selon le mois
function getRecettes($mois) {
    $mois = strtolower(trim($mois));
    $basePath = __DIR__ . '/generateurderecette/';
    $fichier = $basePath . $mois . '.json';

    if (!file_exists($fichier)) {
        return [
            "entree" => "Aucune donnée disponible pour ce mois.",
            "plat" => "",
            "dessert" => ""
        ];
    }

    // Lecture du fichier JSON
    $jsonData = file_get_contents($fichier);
    $data = json_decode($jsonData, true);

    if (!$data) {
        return [
            "entree" => "Erreur de lecture du fichier JSON.",
            "plat" => "",
            "dessert" => ""
        ];
    }

    // Choix aléatoire de chaque catégorie
    return [
        "entree" => $data["entree"][array_rand($data["entree"])],
        "plat" => $data["plat"][array_rand($data["plat"])],
        "dessert" => $data["dessert"][array_rand($data["dessert"])]
    ];
}

// Gestion AJAX
if (isset($_POST['mois'])) {
    header('Content-Type: application/json');
    echo json_encode(getRecettes($_POST['mois']));
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur de Recettes Gastronomiques</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>🍷 Générateur de Recettes Françaises de Saison 🇫🇷</h1>

        <div class="form">
            <label for="mois">Choisissez un mois :</label>
            <select id="mois">
                <option value="">-- Sélectionnez --</option>
                <option>Janvier</option>
                <option>Février</option>
                <option>Mars</option>
                <option>Avril</option>
                <option>Mai</option>
                <option>Juin</option>
                <option>Juillet</option>
                <option>Août</option>
                <option>Septembre</option>
                <option>Octobre</option>
                <option>Novembre</option>
                <option>Décembre</option>
            </select>
            <button id="generate">Générer</button>
        </div>

        <div id="result" class="result"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>
