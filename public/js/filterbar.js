// Obtenir le formulaire
const form = document.getElementById('filterbar');

const selectElements = [
    document.getElementById('structure'),
    document.getElementById('status'),
    document.getElementById('participants')
]
selectElements.forEach(select => {
    // Ajouter un événement lors du changement de la sélection
    select.addEventListener('change', function (e) {
        // Empêcher le comportement par défaut de soumission du formulaire
        e.preventDefault();
        // Récupérer les paramètres du formulaire
        var formData = new FormData(form);
        console.log(formData)
        // Construire l'URL avec les paramètres
        var url = form.action + '?' + new URLSearchParams(formData).toString();

        // Rediriger vers la nouvelle URL
        window.location.href = url;
    });
});