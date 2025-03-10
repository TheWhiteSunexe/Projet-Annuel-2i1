function fetchClients() {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIClient.php')
        .then(response => response.json())
        .then(clients => {
            const tableBody = document.querySelector('#clients-table tbody');
            tableBody.innerHTML = '';

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
                    <td>${client.entreprise}</td>
                    <td>
                        ${actionButton}
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="users-profile.php?id=${client.id}" target="_blank"><i class="bi-info-circle"></i> Info</a>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des clients :", error));
}

document.addEventListener("DOMContentLoaded", () => {
    fetchClients();
});


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