document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiDevis.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucun devis trouvé</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let statusText = '';
                let acceptanceText = '';

                
                if (contracts.status == 1){
                    statusText = 'Vient d\'être créé';
                }else if(contracts.status == 2){
                    statusText = 'Accepté';
                }else if(contracts.status == 3){
                    statusText = 'Les prestataires postulent';
                }else if(contracts.status == 4){
                    statusText = 'proposition du contrat';
                }else{
                    statusText = 'Statut inconnu';
                }

                if (contracts.active == 1) {
                    acceptanceText = 'En cours';
                } else if(contracts.active == 2){
                    acceptanceText = 'Accepté';
                }else{
                    acceptanceText = 'Non accepté';
                }

                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td>${contracts.title}</td>
                    <td>${contracts.description}</td>
                    <td>${statusText}</td>
                    <td>${acceptanceText}</td>
                    <td><button class="btn btn-primary profile-button">Télécharger</button></td>
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


function addDevis(){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/addDevis.php';
}