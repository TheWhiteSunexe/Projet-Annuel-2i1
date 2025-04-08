document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiApplication.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucun contrat trouvé</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let row = document.createElement("tr");
                row.innerHTML = `
                <td>${contracts.id}</td>
                <td>${contracts.name}</td>
                <td>${contracts.date}</td>
                <td>${contracts.title}</td>
                <td>${contracts.description}</td> 
                <td>
                    <form action="/Projet-Annuel-2i1/PA2i1/api/ApiApplication.php" method="POST">
                        <input type="hidden" name="contract_id" value="${contracts.id}">
                        <input type="text" name="price" required>
                        
                        <button class="btn btn-success profile-button" type="submit">
                            <i class="bi bi-clipboard-check"></i> Postuler
                        </button>
                    </form>
                </td>
                </td>
                    <button class="btn btn-primary profile-button" href="download.php?id=${contracts.id}&type=contract"><i class="bi-info-circle"></i> Info</button>
                </td>
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
