document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiRoom.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contractTableBody');
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="8">Aucune salle trouvée</td></tr>`;
                return;
            }

            data.forEach(room => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${room.id}</td>
                    <td>${room.name}</td>
                    <td>${room.capacity}</td>
                    <td>${room.address}</td>
                    <td>${room.city}</td>
                    <td>${room.postal_code}</td>
                    <td>${room.country}</td>
                    <td>
                        <a href="javascript:void(0);" onclick="modifyRoom(${room.id})">
                            <i class="bi bi-pen"></i>
                        </a>
                        
                        <a href="javascript:void(0);" onclick="deleteRoom(${room.id})">
                            <i class="bi bi-trash" style="color: red;"></i>
                        </a>
                    </td>


                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des salles:', error);
            document.getElementById('contractTableBody').innerHTML =
                `<tr><td colspan="7" style="color: red;">Erreur de chargement</td></tr>`;
        });
});

function addRoom(){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/addRoom.php';
}
function modifyRoom(id){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/devis.php';
}
function deleteRoom(id){
    window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/devis.php';
}