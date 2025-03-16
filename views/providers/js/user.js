document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?user=providers')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.data;
                // Pour la partie a afficher ( ne pas modifier)
                document.getElementById("full-name-title").textContent = user.firstname + " " + user.name;
                document.getElementById("full-name").textContent = user.firstname + " " + user.name;
                document.getElementById("company-title").textContent = user.company_name || "N/A";
                document.getElementById("company").textContent = user.company_name || "N/A";
                document.getElementById("phone").textContent = user.phone || "N/A";
                document.getElementById("email").textContent = user.email || "N/A";
                document.getElementById("siret").textContent = user.siret || "N/A";
                document.getElementById("service_type").textContent = user.service_type || "N/A";
                document.getElementById("service_description").textContent = user.service_description || "N/A";
                document.getElementById("address").textContent = user.address || "N/A";
                document.getElementById("postal_code").textContent = user.postal_code || "N/A";
                document.getElementById("country").textContent = user.country || "N/A";
                document.getElementById("vat_number").textContent = user.vat_number || "N/A";
                document.getElementById("link").textContent = user.link || "N/A";

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
    const name = document.getElementById('name-update').value;
    const firstname = document.getElementById('firstname-update').value;
    const service_type = document.getElementById('service_type-update').value;
    const service_description = document.getElementById('service_description-update').value;
    const company = document.getElementById('company-update').value;
    const siret = document.getElementById('siret-update').value;
    const vat_number = document.getElementById('vat_number-update').value;
    const country = document.getElementById('country-update').value;
    const address = document.getElementById('address-update').value;
    const postal_code = document.getElementById('postal_code-update').value;
    const phone = document.getElementById('phone-update').value;
    const email = document.getElementById('email-update').value;
    const link = document.getElementById('link-update').value;

    const data = {
        name: name,
        firstname: firstname,
        service_type: service_type,
        service_description: service_description,
        company: company,
        siret: siret,
        vat_number: vat_number,
        country: country,
        address: address,
        postal_code: postal_code,
        phone: phone,
        email: email,
        link: link
    };

    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php?action=update&user=providers', {
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
        alert("Erreur");
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