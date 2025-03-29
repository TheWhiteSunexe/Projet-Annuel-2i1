document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiContract.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="8">Aucun contrat trouvé</td></tr>`;
                return;
            }

            data.forEach(contracts => {
                let row = document.createElement("tr");
                let acceptanceText = '';
                const contractStatus = Number(contracts.status);
                
                if (contractStatus === 4) {
                    acceptanceText = `
                        <button onclick="acceptContract(${contracts.id}, 'accept')" class="btn btn-success profile-button">
                            <i class="bi-check-circle"></i> Accepter
                        </button>
                        <button onclick="refuseContract(${contracts.id}, 'refuse')" class="btn btn-danger profile-button">
                            <i class="bi-x-circle"></i> Refuser
                        </button>`;
                } else if (contractStatus === 5){
                    acceptanceText = `
                        <button onclick="refuseContract(${contracts.id}, 'refuse')" class="btn btn-danger profile-button">
                            <i class="bi-x-circle"></i> Rupture de contrat
                        </button>`;
                } else {
                    acceptanceText = `Problème de lecture / reception de status`;
                }

                row.innerHTML = `
                    <td>${contracts.id}</td>
                    <td>${contracts.name}</td>
                    <td>${contracts.date}</td>
                    <td><button class="btn btn-primary profile-button"><i class="bi-info-circle"></i> Info</button></td>
                    <td>${acceptanceText}</td>
                    <td>${contracts.price}€</td> 
                    <td><button class="btn btn-warning profile-button"><i class="bi-credit-card"></i> Payement</button></td> 
                    <td><button class="btn btn-primary profile-button"><i class="bi-download"></i> Télécharger</button></td>
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

function acceptContract(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/api/APIContract.php', {
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
            location.reload();
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error("Erreur lors de l'envoi de l'acceptation:", error));
}

function refuseContract(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/api/APIContract.php', {
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
            location.reload();
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error('Erreur lors de l\'envoie du refus:', error));
}