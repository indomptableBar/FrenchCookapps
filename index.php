<?php
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

    $jsonData = file_get_contents($fichier);
    $data = json_decode($jsonData, true);

    if (!$data) {
        return [
            "entree" => "Erreur de lecture du fichier JSON.",
            "plat" => "",
            "dessert" => ""
        ];
    }

    return [
        "entree" => $data["entree"][array_rand($data["entree"])],
        "plat" => $data["plat"][array_rand($data["plat"])],
        "dessert" => $data["dessert"][array_rand($data["dessert"])]
    ];
}

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

    <!-- SEO par défaut -->
    <meta name="description" content="Générateur de recettes françaises gastronomiques de saison. Découvrez des entrées, plats et desserts adaptés à chaque mois de l’année.">
    <meta name="keywords" content="recette française, cuisine gastronomique, plat de saison, recette d'hiver, recette d'été, gastronomie française">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1>🍷 Générateur de Recettes Françaises 🇫🇷</h1>
        <div class="form">
            <label for="mois">Choisissez un mois :</label>
            <select id="mois">
                <option value="">-- Sélectionnez --</option>
                <option>Janvier</option>
                <option>Fevrier</option>
                <option>Mars</option>
                <option>Avril</option>
                <option>Mai</option>
                <option>Juin</option>
                <option>Juillet</option>
                <option>Aout</option>
                <option>Septembre</option>
                <option>Octobre</option>
                <option>Novembre</option>
                <option>Decembre</option>
            </select>
            <button id="generate">Générer</button>
        </div>

        <div id="result" class="result"></div>
    </div>

    <!-- ======================== -->
    <!--      MODULE FLOTTANT      -->
    <!-- ======================== -->
    <div class="floating-footer" id="floatingFooter">
        <div class="footer-content">
            <div class="footer-section">
                <h3>🪙 Publicité</h3>
                <div class="adsense">
                    <p><em>Espace réservé pour Google AdSense</em></p>
                </div>
            </div>
            <div class="footer-section">
                <h3>🔑 Mots-clés SEO</h3>
                <div class="keywords" id="seoKeywords">
                    <p>recette française, gastronomie, plat de saison, cuisine de chef, entrée gourmande, dessert raffiné, produits locaux</p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
