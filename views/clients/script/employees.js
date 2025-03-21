document.addEventListener("DOMContentLoaded", function () {
    fetchEmployees();

    // Gestion de l'ajout d'un employé via le formulaire
    document.getElementById("addEmployeeForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const data = {
            action: "add",
            name: document.getElementById("name").value,
            firstname: document.getElementById("firstname").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            enterpriseId: document.getElementById("enterpriseId").value
        };

        fetch('/Projet-Annuel-2i1/PA2i1/api/ApiEmployees.php', {
            method: "POST",
            body: JSON.stringify(data),
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
            let messageBox = document.getElementById("message");
            if (data.success) {
                messageBox.innerHTML = `<p style="color: green;">${data.success}</p>`;
                fetchEmployees(); // Rafraîchir la liste après ajout
            } else {
                messageBox.innerHTML = `<p style="color: red;">${data.error}</p>`;
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'ajout :", error);
            document.getElementById("message").innerHTML = `<p style="color: red;">Erreur inattendue.</p>`;
        });
    });
});

// Fonction pour récupérer et afficher les employés
function fetchEmployees() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiEmployees.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('employeesTableBody');
            tableBody.innerHTML = "";

            if (!data || data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7">Aucun employé trouvé</td></tr>`;
                return;
            }

            data.forEach(employee => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${employee.id || 'N/A'}</td>
                    <td>${employee.name || 'N/A'}</td>
                    <td>${employee.firstname || 'N/A'}</td>
                    <td>${employee.email || 'N/A'}</td>
                    <td>${employee.id_enterprise || 'N/A'}</td>
                    <td>${employee.status == 1 ? "Actif" : "Suspendu"}</td>
                    <td>
                        ${employee.status == 1 
                            ? `<button onclick="changeStatus(${employee.id}, 'suspend')">Suspendre</button>` 
                            : `<button onclick="changeStatus(${employee.id}, 'reactivate')">Réactiver</button>`}
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des employés:', error);
            document.getElementById('employeesTableBody').innerHTML =
                `<tr><td colspan="7" style="color: red;">Erreur de chargement</td></tr>`;
        });
}

// Fonction pour suspendre ou réactiver un employé
function changeStatus(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiEmployees.php', {
        method: 'POST',
        body: JSON.stringify({ action: action, id: id }),
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.success || data.error);
        fetchEmployees();
    })
    .catch(error => console.error("Erreur :", error));
}
