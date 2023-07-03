document.addEventListener('DOMContentLoaded', () => {
    // Obtenir le formulaire
    const form = document.getElementById('filterbar');

    const formElements = [
        document.getElementById('structure'),
        //document.getElementById('status'),
        document.getElementById('participants'),
        document.getElementById('date_start'),
        document.getElementById('date_end')
    ]
    formElements.forEach(element => {
        // Ajouter un événement lors du changement de la sélection
        element.addEventListener('change', function (e) {
            // Empêcher le comportement par défaut de soumission du formulaire
            e.preventDefault();
            // Récupérer les paramètres du formulaire
            var formData = new FormData(form);
            formData.delete('_token');
            // Construire l'URL avec les paramètres
            var url = form.action + '?' + new URLSearchParams(formData).toString();
            console.log(url);
            // Rediriger vers la nouvelle URL
            window.location.href = url;
        });
    });

    function resetFilters() {
        formElements.forEach(element => {
            element.value = 0
        })
    }
    
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const main = document.querySelector('main');
    const eventSection = document.getElementById("event");
    let backdiv; // Déplacer la déclaration de la variable backdiv ici

    filterButton.addEventListener('click', function () {
        filterDropdown.classList.toggle('hidden');
        filterButton.classList.add('border');
        filterButton.classList.add('border-custom-light-purple');

        if (!filterDropdown.classList.contains('hidden')) {
            backdiv = document.createElement('div'); // Utiliser la variable backdiv déclarée à l'extérieur
            backdiv.id = "back-div";
            backdiv.className = "w-full h-full fixed top-4r5 left-17r z-50";
            backdiv.style.backgroundColor = "rgba(24, 41, 70, 0.9)";

            main.appendChild(backdiv); // Ajouter backdiv à main

            main.insertBefore(backdiv, main.firstChild); // Insérer backdiv avant le premier enfant de main
        } else {
            if (backdiv) {
                backdiv.remove(); // Utiliser backdiv pour le supprimer du DOM
            }
        }
    });


    // Ajouter un écouteur d'événement pour les clics sur le document
    document.addEventListener('click', function (event) {
        const target = event.target;
        const filterDropdown = document.getElementById('filterDropdown');
        const backdiv = document.getElementById('back-div');

        // Vérifier si le clic est en dehors du formulaire de filtres et du bouton
        if (backdiv && !filterDropdown.contains(target) && target !== filterButton) {
            // Fermer le formulaire et supprimer le backdiv
            filterDropdown.classList.add('hidden');
            filterButton.classList.remove('border');
            filterButton.classList.remove('border-custom-light-purple');

            if (backdiv) {
                backdiv.remove();
            }
        }
    });
})