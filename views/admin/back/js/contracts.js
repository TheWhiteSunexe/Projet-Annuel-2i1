document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIContract.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucun contrat trouvé</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let statusText = '';
                if (contracts.status == 1){
                    statusText = 'Vient d\'être créé';
                }else if(contracts.status == 2){
                    statusText = 'Accepté';
                }else if(contracts.status == 3){
                    statusText = 'Les prestataires postulent';
                }else if(contracts.status == 4){
                    statusText = 'proposition du contrat';
                }else if(contracts.status == 5){
                    statusText = 'Contrat accepté par le client';
                }else{
                    statusText = 'Statut inconnu';
                }
                
                let row = document.createElement("tr");

                let infoText = '';
                
                infoText = `

                        <button type="button" class="btn btn-success profile-button" data-bs-toggle="modal" data-bs-target="#info${contracts.id}">
                            <i class="bi-info-circle"></i> infos
                        </button>

                        <div class="modal fade" id="info${contracts.id}" tabindex="-1" aria-labelledby="info${contracts.id}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">${contracts.id}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                           <div class="modal-body">
                                <h6 class="modal-text">Information du contrat :</h6>
                                <h6 class="modal-text">Id du contrat : ${contracts.id}</h6>
                                <h6 class="modal-text">Nom de l'entreprise : ${contracts.entreprise || 'Non spécifié'}</h6>
                                <h6 class="modal-text">Nom du contrat : ${contracts.name || 'Non spécifié'}</h6>
                                <h6 class="modal-text">Titre du contrat : ${contracts.title || 'Non spécifié'}</h6>
                                <h6 class="modal-text">Description du contrat : ${contracts.description || 'Non spécifié'}</h6>
                                <h6 class="modal-text">Motif de refus (si existant) : ${contracts.complain || 'Aucun'}</h6>
                                <h6 class="modal-text">Nombre de personnes pour l'évènement : ${contracts.capacity}</h6>
                                <h6 class="modal-text">Lieu de l'évènement : ${contracts.location == 1 ? 'Dans les locaux de l\'entreprise' : 'Chez Business Care'}</h6>
                                <h6 class="modal-text">Évènement médical : ${contracts.is_medical == 1 ? 'Oui' : 'Non'}</h6>

                                <br>
                                <h6 class="modal-text">Information Évènement :</h6>
                                <h6 class="modal-text">Début : ${contracts.start_date || 'Non défini'}, ${contracts.start_hour || 'Non défini'}</h6>
                                <h6 class="modal-text">Fin : ${contracts.end_date || 'Non défini'}, ${contracts.end_hour || 'Non défini'}</h6>
                                <h6 class="modal-text">Salle : ${contracts.nameRoom || 'Non défini'}</h6>
                                <h6 class="modal-text">Adresse : ${contracts.address || 'Non défini'}</h6>
                                <h6 class="modal-text">Code postal : ${contracts.postal_code || 'Non défini'}</h6>
                                <h6 class="modal-text">Pays : ${contracts.country || 'Non défini'}</h6>
                                <h6 class="modal-text">Ville : ${contracts.city || 'Non défini'}</h6>

                                <br>
                                <h6 class="modal-text">Information Prestataire :</h6>
                                <h6 class="modal-text">ID Prestataire : ${contracts.id_provider || 'Non défini'}</h6>
                                <h6 class="modal-text">Nom Prestataire : ${contracts.nameProvider || 'Non défini'}</h6>
                                <h6 class="modal-text">Prénom Prestataire : ${contracts.firstnameProvider || 'Non défini'}</h6>
                                <h6 class="modal-text">Entreprise du Prestataire : ${contracts.company_name || 'Non défini'}</h6>
                                <h6 class="modal-text">Salaire : ${contracts.price !== null ? contracts.price + ' €' : 'Non défini'}</h6>
                                <h6 class="modal-text">Email : ${contracts.email || 'Non défini'}</h6>
                                <h6 class="modal-text">SIRET : ${contracts.siret || 'Non défini'}</h6>
                                <h6 class="modal-text">Téléphone : ${contracts.phone || 'Non défini'}</h6>
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
                    <td>${contracts.date}</td>
                    <td>${contracts.entreprise}</td>
                    <td>${statusText}</td> 
                    <td><button class="btn btn-warning profile-button"><i class="bi-credit-card"></i> Demande de payement</button></td>  
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
