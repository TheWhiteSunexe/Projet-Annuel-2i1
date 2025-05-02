document.addEventListener("DOMContentLoaded", function () {
    fetchClients();
});

function fetchClients() {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIClient.php')
        .then(response => response.json())
        .then(data => {
            const clients = Array.isArray(data) ? data : (Array.isArray(data.clients) ? data.clients : []);
            const tableBody = document.querySelector('#clients-table tbody');
            tableBody.innerHTML = '';

            if (!clients.length) {
                console.warn("Aucun client trouvé ou mauvaise structure JSON :", data);
                tableBody.innerHTML = '<tr><td colspan="7">Aucun client disponible.</td></tr>';
                return;
            }

            clients.forEach(client => {
                let row = document.createElement('tr');

                const activeStatus = Number(client.active); 

                let actionButton = '';
                if (activeStatus === 1) {
                    actionButton = `<button class="btn btn-danger btn-sm" onclick="updateContractStatus(${client.id}, 'rupture')"><i class="bi-journal-x"></i> Rupture de contrat</button>`;
                } else if (activeStatus === 0) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateContractStatus(${client.id}, 'engager')"><i class="bi-journal-check"></i> Engager</button>`;
                }

                row.innerHTML = `
                    <td>${client.id}</td>
                    <td>${client.name}</td>
                    <td>${client.firstname}</td>
                    <td>${client.email}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="Utilisateurs.php?companyId=${client.company_id}" target="_blank"><i class="bi-person-lines-fill"></i>  ${client.company_name}</a>
                    </td>
                    <td>
                        ${actionButton}
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="users-profile.php?id=${client.id}" target="_blank"><i class="bi-person-badge"></i> Info</a>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des clients :", error));
}

function updateContractStatus(clientId, status) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIClient.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: status,
            id: clientId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`Contrat mis à jour : ${status === 'rupture' ? 'Rupture de contrat effectuée' : 'Contrat engagé'}`);
            fetchClients();
        } else {
            alert('Erreur de mise à jour du contrat.');
        }
    })
    .catch(error => console.error('Erreur lors de la mise à jour du contrat:', error));
}
