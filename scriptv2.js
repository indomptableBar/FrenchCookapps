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

        // 🔍 MISE À JOUR DYNAMIQUE DES META POUR SEO
        const moisLower = mois.toLowerCase();

        // Mots-clés dynamiques
        const keywords = [
            `recettes de ${moisLower}`,
            `plats français de ${moisLower}`,
            `desserts de ${moisLower}`,
            `cuisine de saison ${moisLower}`,
            `recettes gastronomiques ${moisLower}`,
            `plats traditionnels français`
        ].join(', ');

        const description = `Découvrez des recettes gastronomiques françaises typiques du mois de ${moisLower} : entrées, plats et desserts raffinés de saison.`;

        // Mise à jour <meta name="description">
        let metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc) metaDesc.setAttribute('content', description);

        // Mise à jour <meta name="keywords">
        let metaKeys = document.querySelector('meta[name="keywords"]');
        if (metaKeys) metaKeys.setAttribute('content', keywords);

        // Mise à jour affichage footer SEO
        document.getElementById('seoKeywords').innerHTML = `<p>${keywords}</p>`;
    })
    .catch(err => {
        document.getElementById('result').innerHTML = "<p>Erreur lors de la génération des recettes.</p>";
        console.error(err);
    });
});
