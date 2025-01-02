// Fonction pour afficher/masquer les options de bannissement
function toggleBanOptions() {
    let option = document.getElementById('options').value;

    // Masquer toutes les options de bannissement
    document.getElementById('banTempDiv').style.display = 'none';
    document.getElementById('banDefDiv').style.display = 'none';

    // Afficher les options correspondantes
    if (option == 'Banni Temporairement') {
        document.getElementById('banTempDiv').style.display = 'block';
    } else if (option == 'Banni Définitivement') {
        document.getElementById('banDefDiv').style.display = 'block';
    }
} 