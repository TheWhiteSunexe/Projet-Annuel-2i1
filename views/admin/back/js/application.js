document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIApplication.php')
        .then(response => response.json())
        .then(data => {
            let accordionContainer = document.getElementById("accordion-container");
            let existingContracts = {}; 

            data.forEach(candidature => {
                let contractId = candidature.id_contract;
                let contractName = candidature.contact_name;

                if (!existingContracts[contractId]) {
                    let accordionItem = document.createElement("div");
                    accordionItem.classList.add("accordion-item");

                    accordionItem.innerHTML = `
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#contract-${contractId}">
                                ${contractName}
                            </button>
                        </h2>
                        <div id="contract-${contractId}" class="accordion-collapse collapse" data-bs-parent="#accordion-container">
                            <div class="accordion-body">
                                <table class="table table-striped mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Entreprise</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Infos</th>
                                            <th>Prix</th>
                                            <th>Adresse</th>
                                            <th>Code postal</th>
                                            <th>Pays</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-${contractId}">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;

                    accordionContainer.appendChild(accordionItem);
                    existingContracts[contractId] = document.getElementById(`table-${contractId}`);
                }

                let tableBody = existingContracts[contractId];
                let row = document.createElement("tr");

                row.innerHTML = `
                    <td>${candidature.application_id}</td> 
                    <td>${candidature.provider_company_name}</td> 
                    <td>${candidature.user_name}</td> 
                    <td>${candidature.firstname}</td> 
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="sendApplication(${candidature.user_id})"><i class="bi bi-info-circle"></i> Voir</button>
                    </td>
                    <td>${candidature.price}</td>
                    <td>${candidature.address}</td> 
                    <td>${candidature.country}</td> 
                    <td>${candidature.postal_code}</td> 
                    <td>
                        <button class="btn btn-success btn-sm" onclick="chooseApplication(${candidature.application_id}, ${candidature.id_contract}, ${candidature.id_provider}, ${candidature.price})"><i class="bi bi-clipboard2-check"></i> Choisir</button>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des candidatures:', error);
        });
});

function chooseApplication(id_application, id_contract, id_provider, price) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APIApplication.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id_application: id_application,
            id_contract: id_contract,
            id_provider: id_provider,
            price: price
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Candidature envoyée avec succès !');
            location.reload();
        } else {
            alert('Erreur lors de l\'envoi de la candidature');
        }
    })
    .catch(error => console.error('Erreur:', error));
}

