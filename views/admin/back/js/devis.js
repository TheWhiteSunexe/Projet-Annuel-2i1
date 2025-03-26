document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIDevis.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucun devis trouvé</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let row = document.createElement("tr");
            
                let statusText = '';
                let publicationText = '';
            
                const contractStatus = Number(contracts.active);
                const contractPublication = Number(contracts.publication);
            
                switch (contractStatus) {
                    case 1:
                        statusText = 'Vient d\'être créé';
                        break;
                    case 2:
                        statusText = 'Accepté';
                        break;
                    case 3:
                        statusText = 'Les prestataires postulent';
                        break;
                    case 4:
                        statusText = 'Proposition du contrat';
                        break;
                    default:
                        statusText = 'Statut inconnu';
                        break;
                }
            
                let acceptanceText = '';
                if (contractStatus === 1) {
                    acceptanceText = `
                        <button onclick="changeStatus(${contracts.id}, 'changeAcceptedStatus')" class="btn btn-success profile-button">
                            <i class="bi-check-circle"></i> Accepter
                        </button>
                        <button onclick="changeStatus(${contracts.id}, 'changeRefusedStatus')" class="btn btn-danger profile-button">
                            <i class="bi-x-circle"></i> Refuser
                        </button>`;
                } else if (contractStatus === 2) {
                    acceptanceText = `
                        <button onclick="changeStatus(${contracts.id}, 'changeRefusedStatus')" class="btn btn-danger profile-button">
                            <i class="bi-x-circle"></i> Abandonner
                        </button>`;
                } else if (contractStatus === 0) {
                    acceptanceText = `
                        <button onclick="" class="btn btn-primary profile-button">
                            <i class="bi-mailbox"></i> Contacter le client
                        </button>`;
                } else {
                    acceptanceText = `Problème de status`;
                }
            
                if (contractPublication === 1) {
                    publicationText = `
                        <button onclick="sendApplications(${contracts.id}, 'endApplication')" class="btn btn-danger profile-button">
                            <i class="bi-x-circle"></i> Retirer l'annonce
                        </button>`;
                } else {
                    publicationText = `
                        <button onclick="sendApplications(${contracts.id}, 'startApplication')" class="btn btn-warning profile-button">
                            <i class="bi-check-circle"></i> Publier l'annonce
                        </button>`;
                }
            
                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td>${statusText}</td>
                    <td>${publicationText}</td>
                    <td>${acceptanceText}</td>
                    <td><button class="btn btn-primary profile-button"><i class="bi-download"></i> Télécharger</button></td>
                    <td><button class="btn btn-success profile-button"><i class="bi-info-circle"></i> infos</button></td>
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

function changeStatus(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIDevis.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: id,        
            action: action 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error('Erreur lors de l\'envoi du signalement:', error));
}

function sendApplications(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIDevis.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: id,        
            action: action 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error('Erreur lors du modification du status des candidatures', error));
}
//Si on a le boutton info sur les devis, pas besoin du titre/description
//<td>${contracts.title}</td>
//<td>${contracts.description}</td>