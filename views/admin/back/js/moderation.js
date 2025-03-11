function fetchModerations() {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIModeration.php')
        .then(response => response.json())
        .then(moderations => {
            const tableBody = document.querySelector('#clients-table tbody');
            tableBody.innerHTML = '';

            moderations.forEach(moderation => {
                let row = document.createElement('tr');

                const activeStatus = Number(moderation.active); 

                let actionButton = '';
                if (activeStatus === 1) {
                    actionButton = `<button class="btn btn-danger btn-sm" onclick="updateContractStatus(${moderation.commentaire_id}, 'rupture')"><i class="bi-eye-slash"></i> Rendre non visible</button>`;
                } else if (activeStatus === 0) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateContractStatus(${moderation.commentaire_id}, 'engager')"><i class="bi-eye"></i> Rendre visible</button>`;
                }

                row.innerHTML = `
                    <td>${moderation.commentaire_id}</td>
                    <td>${moderation.utilisateur_nom}</td>
                    <td>${moderation.commentaire_contenu}</td>
                    <td>${moderation.sujet_titre}</td>
                    <td>${moderation.commentaire_date}</td>
                    <td>
                        ${actionButton}
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="sendReporting(${moderation.commentaire_id}, 'create')"><i class="bi-shield-exclamation"></i> Signaler</button>
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="users-profile.php?id=" target="_blank"><i class="bi-info-circle"></i> Info</a>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des messages :", error));
}

document.addEventListener("DOMContentLoaded", () => {
    fetchModerations();
});


function updateContractStatus(moderationId, status) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIModeration.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: status,
            id: moderationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`Compte mis à jour : ${status === 'rupture' ? 'Compte suspendu avec succès' : 'Compte réactivé avec succès'}`);
            fetchModerations();
        } else {
            alert('Erreur de mise à jour du compte.');
        }
    })
    .catch(error => console.error('Erreur lors de la mise à jour du compte:', error));
}