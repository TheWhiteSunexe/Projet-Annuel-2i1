function getCompanyIdFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('companyId'); 
}

function fetchUsers() {
    const companyId = getCompanyIdFromURL();

    let apiUrl = '/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIUsers.php';
    if (companyId) {
        apiUrl += `?companyId=${companyId}`; 
    }

    fetch(apiUrl)
        .then(response => response.json())
        .then(users => {
            const tableBody = document.querySelector('#clients-table tbody');
            tableBody.innerHTML = '';

            users.forEach(user => {
                let row = document.createElement('tr');

                const activeStatus = Number(user.active); 

                let actionButton = '';
                if (activeStatus === 1) {
                    actionButton = `<button class="btn btn-danger btn-sm" onclick="updateContractStatus(${user.id}, 'rupture')"><i class="bi-exclamation-triangle"></i> Suspendre le compte</button>`;
                } else if (activeStatus === 0) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateContractStatus(${user.id}, 'engager')"><i class="bi-arrow-counterclockwise"></i> Réactiver le compte</button>`;
                }

                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.firstname}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>
                        ${actionButton}
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="users-profile.php?id=${user.id}" target="_blank"><i class="bi-info-circle"></i> Info</a>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des utilisateurs :", error));
}

document.addEventListener("DOMContentLoaded", () => {
    fetchUsers();
});

function updateContractStatus(userId, status) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIUsers.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: status,
            id: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`Compte mis à jour : ${status === 'rupture' ? 'Compte suspendu avec succès' : 'Compte réactivé avec succès'}`);
            fetchUsers(); // Recharger la liste après modification
        } else {
            alert('Erreur de mise à jour du compte.');
        }
    })
    .catch(error => console.error('Erreur lors de la mise à jour du compte:', error));
}