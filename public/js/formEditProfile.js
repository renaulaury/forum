function toggleEditProfile() {
    let form = document.getElementById('formProfile');

    // Affichage du formulaire
    if (form.style.display === 'none') {
        form.style.display = 'block'; 
    } else {
        form.style.display = 'none'; 
    }
}