document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/ApiEvent.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="8">Aucun évènement trouvé</td></tr>`;
                return;
            }

            data.forEach(event => {
                let row = document.createElement("tr");

                const activeStatus = Number(event.active); 

                let actionButton = '';
                if (activeStatus === 1) {
                    actionButton = `<button class="btn btn-danger btn-sm" onclick="updateEventStatus(${event.active}, 'inactif')"><i class="bi-journal-x"></i> Rendre inactif</button>`;
                } else if (activeStatus === 0) {
                    actionButton = `<button class="btn btn-success btn-sm" onclick="updateEventStatus(${event.active}, 'actif')"><i class="bi-journal-check"></i> Rendre actif</button>`;
                }

                row.innerHTML = `
                    <td>${event.id}</td>
                    <td>${event.name}</td>
                    <td>${event.title}</td>
                    <td>${event.description}</td>
                    <td>${event.start_date}, ${event.start_hour}</td>
                    <td>${event.end_date}, ${event.end_hour}</td>
                    <td>${actionButton}</td>
                    <td>
                        <a href="javascript:void(0);" onclick="modifyEvent(${event.id})">
                            <i class="bi bi-pen" style="color: blue;"></i>
                        </a>
                        
                        <a href="javascript:void(0);" onclick="deleteEvent(${event.id})">
                            <i class="bi bi-trash" style="color: red;"></i>
                        </a>
                    </td>


                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des évènements:', error);
            document.getElementById('contractTableBody').innerHTML =
                `<tr><td colspan="7" style="color: red;">Erreur de chargement</td></tr>`;
        });
});

function addRoom(){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/admin/back/addRoom.php';
}
function modifyRoom(id){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/devis.php';
}
function deleteRoom(id){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/devis.php';
}