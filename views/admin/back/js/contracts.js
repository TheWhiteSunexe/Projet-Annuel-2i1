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
                    statusText = 'Les prestataires postulent';
                }else if(contracts.status == 5){
                    statusText = 'proposition du contrat';
                }else if(contracts.status == 6){
                    statusText = 'Contrat accepté par le client';
                }else{
                    statusText = 'Statut inconnu';
                }
                
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td>${contracts.entreprise}</td>
                    <td>${statusText}</td> 
                    <td><button class="btn btn-warning profile-button"><i class="bi-credit-card"></i> Demande de payement</button></td>  
                    <td><button class="btn btn-primary profile-button"><i class="bi-download"></i> Télécharger</button></td>
                    <td><button class="btn btn-success profile-button"><i class="bi-info-circle"></i> Info</button></td>
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
