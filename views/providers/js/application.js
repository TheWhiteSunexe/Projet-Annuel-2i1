document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiApplication.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucune offre d'emploi trouvée</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let row = document.createElement("tr");

                let participantsInfo = contracts.participant === null 
                ? ` Nombre de participants non précisé` 
                : `${contracts.participant}`;

                let infoModal = `
                    <button type="button" class="btn btn-success profile-button" data-bs-toggle="modal" data-bs-target="#info${contracts.id}">
                        <i class="bi bi-info-circle"></i> Info
                    </button>

                    <div class="modal fade" id="info${contracts.id}" tabindex="-1" aria-labelledby="info${contracts.id}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Demande #${contracts.id}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nom :</strong> ${contracts.name}</p>
                                    <p><strong>Date :</strong> ${contracts.date}</p>
                                    <p><strong>Titre :</strong> ${contracts.title}</p>
                                    <p><strong>Description :</strong> ${contracts.description}</p>
                                    <hr>
                                    <p><strong>Évènement :</strong></p>
                                    <p><strong>Date de début :</strong> ${contracts.start_date}</p>
                                    <p><strong>Date de fin :</strong> ${contracts.end_date}</p>
                                    <p><strong>Heure de début :</strong> ${contracts.start_hour}</p>
                                    <p><strong>Heure de fin :</strong> ${contracts.end_hour}</p>
                                    <p><strong>Participants :</strong> ${participantsInfo}</p>
                                    <hr>
                                    <p><strong>Salle :</strong> ${contracts.roomName}</p>
                                    <p><strong>Adresse :</strong> ${contracts.address}, ${contracts.postal_code} ${contracts.city}, ${contracts.country}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                `;

                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td>${contracts.title}</td>
                    <td>${contracts.description}</td> 
                    <td>
                        <form action="/Projet-Annuel-2i1/PA2i1/api/ApiApplication.php" method="POST">
                            <input type="hidden" name="contract_id" value="${contracts.id}">
                            <input type="text" name="price" placeholder="Votre prix" required>
                            <button class="btn btn-success profile-button" type="submit">
                                <i class="bi bi-clipboard-check"></i> Postuler
                            </button>
                        </form>
                    </td>
                    <td>${infoModal}</td>
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
