/*Burger coloré*/
const accessibilite = document.querySelector('#accessibilite');
const accessColors = document.querySelector('.accessColors');

accessibilite.addEventListener('click', () => {
    accessibilite.classList.toggle('open');
    accessColors.classList.toggle('open');
});

// Sélectionner tous les cercles
const circles = document.querySelectorAll('.accessColors i');

// Ajouter un événement au clic pour chaque cercle
circles.forEach(circle => {
    circle.addEventListener('click', () => {
        // Récupérer la couleur depuis la classe du cercle (ex : 'blue', 'yellow', etc.)
        const color = circle.classList[1];

        // Récupérer toutes les feuilles de style
        const stylesheets = document.styleSheets;

        // Parcourir chaque feuille de style
        Array.from(stylesheets).forEach(sheet => {
            try {
                // Parcourir les règles de chaque feuille de style
                Array.from(sheet.cssRules || sheet.rules).forEach(rule => {
                    // Si la règle contient la propriété 'color', la modifier
                    if (rule.style && rule.style.color) {
                        rule.style.color = color;
                    }
                });
            } catch (e) {
                // Ignorer les erreurs liées aux restrictions de sécurité (comme les fichiers externes)
                console.error('Erreur d\'accès à la feuille de style:', e);
            }
        });
    });
});
