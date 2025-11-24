document.getElementById('generate').addEventListener('click', function() {
    const mois = document.getElementById('mois').value;

    if (!mois) {
        alert("Veuillez sélectionner un mois !");
        return;
    }

    fetch('index.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'mois=' + encodeURIComponent(mois)
    })
    .then(response => response.json())
    .then(data => {
        // Construire les URLs Marmiton (recherche du plat)
        const entreeLink = "https://www.marmiton.org/recettes/recherche.aspx?aqt=" + encodeURIComponent(data.entree);
        const platLink = "https://www.marmiton.org/recettes/recherche.aspx?aqt=" + encodeURIComponent(data.plat);
        const dessertLink = "https://www.marmiton.org/recettes/recherche.aspx?aqt=" + encodeURIComponent(data.dessert);

        document.getElementById('result').innerHTML = `
            <div class="recette-col">
                <h2>🍽️ Résultats pour ${mois}</h2>
                <p><strong>Entrée :</strong> ${data.entree}</p>
                <p><strong>Plat :</strong> ${data.plat}</p>
                <p><strong>Dessert :</strong> ${data.dessert}</p>
            </div>
            <div class="links-col">
                <h2>🔗 Liens Marmiton</h2>
                <a class="marmiton" href="${entreeLink}" target="_blank">Voir l’entrée</a>
                <a class="marmiton" href="${platLink}" target="_blank">Voir le plat</a>
                <a class="marmiton" href="${dessertLink}" target="_blank">Voir le dessert</a>
            </div>
        `;
    })
    .catch(err => {
        document.getElementById('result').innerHTML = "<p>Erreur lors de la génération des recettes.</p>";
        console.error(err);
    });
});
