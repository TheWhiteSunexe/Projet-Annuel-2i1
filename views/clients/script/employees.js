document.addEventListener("DOMContentLoaded", function () {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiEmployees.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('employeesTableBody');
            tableBody.innerHTML = "";

            if (!data || data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5">Aucun employé trouvé</td></tr>`; 
                return;
            }

            data.forEach(employee => { 
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${employee.id || 'N/A'}</td>
                    <td>${employee.name || 'N/A'}</td>
                    <td>${employee.firstname || 'N/A'}</td>
                    <td>${employee.email || 'N/A'}</td>
                    <td><a href="#">Action</a></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des employés:', error);
            document.getElementById('employeesTableBody').innerHTML =
                `<tr><td colspan="5" style="color: red;">Erreur de chargement</td></tr>`; 
        });
});
