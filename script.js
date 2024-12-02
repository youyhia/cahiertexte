// script.js

// Fonction pour afficher un message d'alerte avec un délai
function showAlert(message) {
    alert(message);
}

// Fonction pour valider un formulaire (par exemple, pour ajouter un professeur)
function validateForm(form) {
    let valid = true;
    let errorMessage = "";

    if (form.nom.value == "") {
        valid = false;
        errorMessage += "Le nom est requis.\n";
    }

    if (form.email.value == "") {
        valid = false;
        errorMessage += "L'email est requis.\n";
    } else if (!validateEmail(form.email.value)) {
        valid = false;
        errorMessage += "L'email est invalide.\n";
    }

    if (!valid) {
        alert(errorMessage);
    }

    return valid;
}

// Fonction pour valider un email
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return re.test(email);
}

// Fonction pour la confirmation avant de supprimer un professeur
function confirmDelete(professeurId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce professeur ?")) {
        // Vous pouvez ajouter ici une logique pour effectuer la suppression via AJAX
        console.log("Professeur " + professeurId + " supprimé.");
    }
}

// Fonction pour ajouter des animations simples sur le survol des boutons
function addHoverEffect() {
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.backgroundColor = '#ff7f50'; // couleur orange clair au survol
        });
        button.addEventListener('mouseleave', () => {
            button.style.backgroundColor = ''; // couleur par défaut
        });
    });
}

// Appeler la fonction d'animation sur les boutons dès que le DOM est prêt
document.addEventListener('DOMContentLoaded', addHoverEffect);
