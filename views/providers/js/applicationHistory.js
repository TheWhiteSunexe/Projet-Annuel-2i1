document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiApplicationHistory.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucune candidature trouvée</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                const status = contracts.active == 1 ? "En cours d'analyse" : "Rejetée";

                let row = document.createElement("tr");

                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td>${contracts.title}</td>
                    <td>${contracts.description}</td> 
                    <td>${contracts.price}</td> 
                    <td>${status}</td> 
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des contrats:', error);
            document.getElementById('contractTableBody').innerHTML =
                `<tr><td colspan="7" style="color: red;">Erreur de chargement</td></tr>`;
        });
});
