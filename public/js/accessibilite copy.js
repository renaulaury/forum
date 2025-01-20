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
 function colorTheme(color) {
        switch(color) {
            case 'peach':

                    document.documentElement.style.setProperty('--color-title-icon', '#944C43');  
                    document.documentElement.style.setProperty('--color-texte', 'rgb(34, 34, 34)');  
                    document.documentElement.style.setProperty('--color-texte-footer', 'rgb(34, 34, 34)');  
                    document.documentElement.style.setProperty('--color-bande', '#FFA07A');  
                    document.documentElement.style.setProperty('--color-back-footer', '#FA8072'); 
                    document.documentElement.style.setProperty('--color-background', 'rgba(255, 160, 122, 0.17)');  
                    document.documentElement.style.setProperty('--color-gradient-start', '#FFBFA6');  
                    document.documentElement.style.setProperty('--color-gradient-end', '#FA8072');  
                    break;

            case 'blue':

                document.documentElement.style.setProperty('--color-title-icon', '#3366cc'); 
                document.documentElement.style.setProperty('--color-texte', 'rgb(34, 34, 34)');  
                document.documentElement.style.setProperty('--color-texte-footer', 'RGB(245, 245, 245)');  //whitesmoke
                document.documentElement.style.setProperty('--color-bande', '#66aaff');  
                document.documentElement.style.setProperty('--color-back-footer', 'rgb(16, 30, 125)'); 
                document.documentElement.style.setProperty('--color-background', 'rgba(51, 102, 204, 0.1)');  
                document.documentElement.style.setProperty('--color-gradient-start', '#6699ff');  r
                document.documentElement.style.setProperty('--color-gradient-end', '#1a66ff');  
                break;

            case 'purple':

                document.documentElement.style.setProperty('--color-title-icon', 'rgb(138, 41, 186)');
                document.documentElement.style.setProperty('--color-texte', 'rgb(34, 34, 34)');                
                document.documentElement.style.setProperty('--color-texte-footer', 'RGB(245, 245, 245)');  //whitesmoke
                document.documentElement.style.setProperty('--color-bande', 'rgb(151, 86, 184)'); 
                document.documentElement.style.setProperty('--color-back-footer', 'rgb(87, 2, 107)'); 
                document.documentElement.style.setProperty('--color-background', 'rgba(138, 41, 186, 0.1)');
                document.documentElement.style.setProperty('--color-gradient-start', '#B367FF');
                document.documentElement.style.setProperty('--color-gradient-end', '#8A29BA');
                break;

            case 'green':

                document.documentElement.style.setProperty('--color-title-icon', 'rgb(25, 129, 25)');
                document.documentElement.style.setProperty('--color-texte', 'rgb(34, 34, 34)');                             
                document.documentElement.style.setProperty('--color-texte-footer', 'RGB(245, 245, 245)');  //whitesmoke
                document.documentElement.style.setProperty('--color-bande', '#98FB98');
                document.documentElement.style.setProperty('--color-back-footer', 'rgb(12, 118, 35)'); 
                document.documentElement.style.setProperty('--color-background', 'rgba(25, 129, 25, 0.1)');
                document.documentElement.style.setProperty('--color-gradient-start', '#7CFF6F');
                document.documentElement.style.setProperty('--color-gradient-end', '#29A329');
                break;

            case 'dark':
                document.body.style.backgroundColor = '#1e1e1e';  
                document.documentElement.style.setProperty('--color-texte', 'whitesmoke'); 
                break;
                
                default:
                break;
        }
    }

// Applique la couleur choisie au chargement si elle existe
const savedColor = localStorage.getItem('themeColor');
if (savedColor) {
    colorTheme(savedColor);
}

// Fonction pour changer les couleurs du site
colorCircles.forEach(circle => {
    circle.addEventListener('click', (e) => {
        const color = e.target.getAttribute('data-color');
        localStorage.setItem('themeColor', color); // Sauvegarde la couleur dans le localStorage
        colorTheme(savedColor);
    });
});



