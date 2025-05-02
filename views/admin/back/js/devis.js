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
                let infoText = '';
            
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
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal${contracts.id}">
                            <i class="bi-check-circle"></i> Publier l'annonce
                        </button>

                        <div class="modal fade" id="exampleModal${contracts.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Publication de l'annonce :</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                               <form action="/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIDevis.php?action=startApplication" method="POST">
                                    <!-- Champ caché pour stocker l'ID du contrat -->

                                    <input type="hidden" name="id" id="id" value="${contracts.id}">

                                    <input type="hidden" name="id_company" id="id_company" value="${contracts.id_entreprise}">

                                    <div class="form-group">
                                        <label for="title">Titre de l'évènement :</label>
                                        <textarea type="text" id="title" name="title" class="form-control" value="${contracts.title}" >${contracts.title}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description de l'évènement :</label>
                                        <textarea type="text" id="description" name="description" class="form-control" value="${contracts.description}" >${contracts.description}</textarea>
                                    </div>

                                    <!-- Champs pour publier l'annonce : -->
                                    <div class="form-group">
                                        <label for="room">Sélection de la salle (id) :</label>
                                        <input type="text" id="room" name="room" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Sélection de la date de début :</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date">Sélection de la date de fin :</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="start_time">Sélection de l'horaire de début :</label>
                                        <input type="time" id="start_time" name="start_time" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_time">Sélection de l'horaire de fin :</label>
                                        <input type="time" id="end_time" name="end_time" class="form-control" required>
                                    </div>

                                    <!-- Bouton submit -->
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        Publier l'annonce
                                    </button>
                                </form>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                
                            </div>
                            </div>
                        </div>
                        </div>
                        `;
                }
                infoText = `

                        <button type="button" class="btn btn-success profile-button" data-bs-toggle="modal" data-bs-target="#info${contracts.id}">
                            <i class="bi-info-circle"></i> infos
                        </button>

                        <div class="modal fade" id="info${contracts.id}" tabindex="-1" aria-labelledby="info${contracts.id}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Plus d'informations :</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="modal-text">Nom : ${contracts.name}</h6>
                                <h6 class="modal-text">Titre de la demande : ${contracts.title}</h6>
                                <h6 class="modal-text">Contenu : ${contracts.description || 'Non spécifié'}</h6>
                                <h6 class="modal-text">Status de la demande : ${contracts.status == 2 ? 'Validé' : 'En attente ou refusé'}</h6>
                                <h6 class="modal-text">Etat de publication : ${contracts.publication == 1 ? 'Publié' : 'Non publié'}</h6>
                                <h6 class="modal-text">Nom de l'entreprise : ${contracts.entreprise}</h6>
                                <h6 class="modal-text">Id entreprise : ${contracts.id_entreprise}</h6>
                                <h6 class="modal-text">Nombre de personnes pour l'évènement : ${contracts.capacity}</h6>
                                <h6 class="modal-text">Motif de refus (si existant) : ${contracts.complain || 'Aucun'}</h6>
                                <h6 class="modal-text">Lieu de l'évènement : ${contracts.location == 1 ? 'Dans les locaux de l\'entreprise' : 'Chez Business Care'}</h6>
                                <h6 class="modal-text">Évènement médical : ${contracts.is_medical == 1 ? 'Oui' : 'Non'}</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>`;
            
                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="clients.php?id=${contracts.id_entreprise}"><i class="bi-person-lines-fill"></i>  ${contracts.entreprise}</a>
                    </td>
                    <td>${contracts.date}</td>
                    <td>${statusText}</td>
                    <td>${publicationText}</td>
                    <td>${acceptanceText}</td>
                    <td><button class="btn btn-primary profile-button"><i class="bi-download"></i> Télécharger</button></td>
                    <td>${infoText}</td>
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