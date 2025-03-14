document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiUser.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.data;
                document.getElementById("full-name").textContent = user.name + " " + user.firstname;
                document.getElementById("company").textContent = user.company_name || "N/A";
                document.getElementById("job").textContent = user.job || "N/A";
                document.getElementById("country").textContent = user.country || "N/A";
                document.getElementById("address").textContent = user.address || "N/A";
                document.getElementById("phone").textContent = user.phone || "N/A";
                document.getElementById("email").textContent = user.email || "N/A";
            } else {
                console.error("Erreur lors du chargement du profil :", data.error);
            }
        })
        .catch(error => console.error("Erreur API :", error));
});
