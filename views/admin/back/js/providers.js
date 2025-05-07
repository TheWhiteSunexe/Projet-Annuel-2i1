function fetchProviders() {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIProviders.php')
        .then(response => response.json())
        .then(providers => {
            const tableBody = document.querySelector('#clients-table tbody');
            tableBody.innerHTML = '';

            providers.forEach(provider => {
                let row = document.createElement('tr');

                const activeStatus = Number(provider.statut); 

                let actionButton = '';
                if (activeStatus === 2) {
                    actionButton = `<button class="btn btn-danger btn-sm" onclick="updateContractStatus(${provider.id}, 'rupture')"><i class="bi-journal-x"></i> Rupture de contrat</button>`;
                } else if (activeStatus === 0) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateContractStatus(${provider.id}, 'engager')"><i class="bi-journal-check"></i> Engager</button>`;
                }else if (activeStatus === 1) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateContractStatus(${provider.id}, 'engager')"><i class="bi-journal-check"></i> Engager</button>
                                    <button class="btn btn-danger btn-sm" onclick="updateContractStatus(${provider.id}, 'rupture')"><i class="bi-journal-x"></i> Rupture de contrat</button>`;
                }

                row.innerHTML = `
                    <td>${provider.id}</td>
                    <td>${provider.name}</td>
                    <td>${provider.firstname}</td>
                    <td>${provider.email}</td>
                    <td>
                        ${actionButton}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="cvDownload.php?id=${provider.id}" target="_blank"><i class="bi-download"></i> Voir CV</a>
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="users-profile.php?id=${provider.id}" target="_blank"><i class="bi-info-circle"></i> Info</a>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des fournisseurs :", error));
}

document.addEventListener("DOMContentLoaded", () => {
    fetchProviders();
});


function updateContractStatus(providerId, status) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIProviders.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: status,
            id: providerId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`Contrat mis à jour : ${status === 'rupture' ? 'Rupture de contrat effectuée' : 'Contrat engagé'}`);
            fetchProviders();
        } else {
            alert('Erreur de mise à jour du contrat.');
        }
    })
    .catch(error => console.error('Erreur lors de la mise à jour du contrat:', error));
}