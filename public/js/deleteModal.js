//Récupérer le formulaire
var deleteForm = document.getElementById("deleteForm");

//Récupérer le modal
var deleteModal = document.getElementById("confirmDeleteModal");
//Récupérer les boutons supprimer dans la list des événements
var deleteButtons = document.querySelectorAll('.delete-button');

//Pour chaque boutton supprimer ajout d'un eventListenner au click si click rend visible le modal
deleteButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        deleteModal.classList.remove('hidden');
    });
});

//Récupérer le bouton de confirmation de suppresion
var deleteButton = document.getElementById("confirmDeleteButton");
//Submit form and hidden modal
deleteButton.addEventListener('click', function (event) {
    event.preventDefault();
    deleteModal.classList.add('hidden');
    deleteForm.submit();
});

//Récupérer le bouton de retour
let cancelButton = document.getElementById("cancelButton");
cancelButton.addEventListener('click', () => {
    deleteModal.classList.add("hidden");
})


