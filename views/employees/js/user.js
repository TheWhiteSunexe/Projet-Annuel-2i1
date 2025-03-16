document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?user=employees')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.data;
                // Pour la partie a afficher ( ne pas modifier)
                document.getElementById("full-name-title").textContent = user.firstname + " " + user.name;
                document.getElementById("full-name").textContent = user.firstname + " " + user.name;
                document.getElementById("company").textContent = user.company_name || "N/A";
                document.getElementById("phone").textContent = user.phone || "N/A";
                document.getElementById("email").textContent = user.email || "N/A";

                // Pour la partie Modification du Profil
                document.getElementById("name-update").textContent = user.name || "N/A";
                document.getElementById("firstname-update").textContent = user.firstname || "N/A";
                document.getElementById("company-update").textContent = user.company_name || "N/A";
                document.getElementById("phone-update").textContent = user.phone || "N/A";
                document.getElementById("email-update").textContent = user.email || "N/A";
            } else {
                console.error("Erreur lors du chargement du profil :", data.error);
            }
        })
        .catch(error => console.error("Erreur API :", error));
});

function uploadProfileImage() {
    const input = document.getElementById('profileImageInput');
    const file = input.files[0];

    if (!file) {
        alert("Veuillez sélectionner une image.");
        return;
    }

    const formData = new FormData();
    formData.append("profile_image", file);

    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?action=upload', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Image mise à jour !");
            document.querySelector("img[alt='Profile']").src = data.image_url;
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error("L'image a été ajouter, veuillez vous déconnecter pour l'afficher", error));
}

function deleteimg() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?action=delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("L'image a été supprimée avec succès !");
        } else {
            alert("Erreur lors de l'action : " + data.error);
        }
    })
    .catch(error => {
        alert("L'image a été supprimée, veuillez vous déconnecter.");
    });
}

document.getElementById('updateForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    const phone = document.getElementById('phone-update').value;
    const linkedin = document.getElementById('linkedin-update').value;

    const data = {
        phone: phone,
        linkedin: linkedin
    };

    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?action=update&user=employees', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Données envoyées avec succès !");
        } else {
            alert("Erreur lors de l'envoi des données : " + data.error);
        }
    })
    .catch(error => {
        alert("Profil modifié");
        console.error("Erreur:", error);
    });
});

function deleteAccount() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?action=deleteAccount', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("L'accès à votre compte à été supprimée avec succès, veuillez vous déconnecter");
        } else {
            alert("Erreur lors de l'action : " + data.error);
        }
    })
    .catch(error => {
        alert("Erreur lors de la supression du compte");
    });
}