/*Burger coloré*/
const accessibilite = document.querySelector('#accessibilite');
const accessColors = document.querySelector('.accessColors');

accessibilite.addEventListener('click', () => {
    accessibilite.classList.toggle('open');
    accessColors.classList.toggle('open');
});

/*Action pour transformer le site*/

// Sélectionner tous les cercles
const circles = document.querySelectorAll('.accessColors i');

// Ajouter un événement au clic sur chaque cercle
circles.forEach(circle => {
    circle.addEventListener('click', () => {
        // Récupérer la couleur de l'élément cliqué
        const color = circle.classList[1]; // La deuxième classe (ex : blue, yellow, etc.)
        
        // Appliquer la couleur comme arrière-plan du body
        document.body.style.backgroundColor = color;
    });
});