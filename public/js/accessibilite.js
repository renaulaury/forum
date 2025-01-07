/*Burger coloré*/
const accessibilite = document.querySelector('#accessibilite');
const accessColors = document.querySelector('.accessColors');

// Gestion de l'ouverture/fermeture du menu de couleurs
accessibilite.addEventListener('click', () => {
    accessibilite.classList.toggle('open');
    accessColors.classList.toggle('open');
});



const colorCircles = document.querySelectorAll('.accessColors i');


// Fonction pour changer les couleurs du site
colorCircles.forEach(circle => {
    circle.addEventListener('click', (e) => {
        const color = e.target.getAttribute('data-color');
        
        switch(color) {
            case 'peach':

                    document.documentElement.style.setProperty('--color-primary', '#944C43');  // Couleur principale
                    document.documentElement.style.setProperty('--color-secondary', 'rgb(34, 34, 34)');  // Texte gris foncé
                    document.documentElement.style.setProperty('--color-highlight', '#FFA07A');  // Couleur pêche claire
                    document.documentElement.style.setProperty('--color-background', 'rgba(255, 160, 122, 0.17)');  // Fond pêche léger
                    document.documentElement.style.setProperty('--color-overlay', 'rgba(255, 255, 255, 0.4)');  // Superposition blanche
                    document.documentElement.style.setProperty('--color-gradient-start', '#FFBFA6');  // Dégradé pêche clair
                    document.documentElement.style.setProperty('--color-gradient-end', '#FA8072');  // Dégradé pêche foncé
                    document.documentElement.style.setProperty('--color-grey-dark', 'rgb(58, 57, 57)');  // Gris foncé inchangé
                    break;

            case 'blue':

                document.documentElement.style.setProperty('--color-primary', '#3366cc');  // Bleu principal
                document.documentElement.style.setProperty('--color-secondary', 'rgb(34, 34, 34)');  // Blanc pour le texte
                document.documentElement.style.setProperty('--color-highlight', '#66aaff');  // Bleu clair pour les accents
                document.documentElement.style.setProperty('--color-background', 'rgba(51, 102, 204, 0.1)');  // Fond léger bleu
                document.documentElement.style.setProperty('--color-overlay', 'rgba(255, 255, 255, 0.4)');  // Superposition blanche
                document.documentElement.style.setProperty('--color-gradient-start', '#6699ff');  // Dégradé bleu clair
                document.documentElement.style.setProperty('--color-gradient-end', '#1a66ff');  // Dégradé bleu foncé
                document.documentElement.style.setProperty('--color-grey-dark', 'rgb(58, 57, 57)');  // Gris foncé inchangé
                break;

            case 'purple':

                document.documentElement.style.setProperty('--color-primary', 'rgb(138, 41, 186)');
                document.documentElement.style.setProperty('--color-secondary', 'rgb(34, 34, 34)');
                document.documentElement.style.setProperty('--color-highlight', '#D8A2FF'); 
                document.documentElement.style.setProperty('--color-background', 'rgba(138, 41, 186, 0.1)');
                document.documentElement.style.setProperty('--color-overlay', 'rgba(255, 255, 255, 0.4)');  // Superposition blanche
                document.documentElement.style.setProperty('--color-gradient-start', '#B367FF');
                document.documentElement.style.setProperty('--color-gradient-end', '#8A29BA');
                document.documentElement.style.setProperty('--color-grey-dark', 'rgb(58, 57, 57)');
                break;

            case 'green':

                document.documentElement.style.setProperty('--color-primary', 'rgb(25, 129, 25)');
                document.documentElement.style.setProperty('--color-secondary', 'rgb(34, 34, 34)');
                document.documentElement.style.setProperty('--color-highlight', '#98FB98');
                document.documentElement.style.setProperty('--color-background', 'rgba(25, 129, 25, 0.1)');
                document.documentElement.style.setProperty('--color-overlay', 'rgba(255, 255, 255, 0.4)');  // Superposition blanche
                document.documentElement.style.setProperty('--color-gradient-start', '#7CFF6F');
                document.documentElement.style.setProperty('--color-gradient-end', '#29A329');
                document.documentElement.style.setProperty('--color-grey-dark', 'rgb(58, 57, 57)');
                break;

            case 'dark':

                document.body.style.backgroundColor = '#1e1e1e';  
                document.documentElement.style.setProperty('--color-secondary', 'whitesmoke'); 
                break;
                
            case 'light':

                document.documentElement.style.setProperty('--color-background', '#whitesmoke'); 
                break;
                
                default:
                break;
        }
    });
});




