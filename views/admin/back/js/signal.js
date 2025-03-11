document.addEventListener("DOMContentLoaded", function () { 
    function displaySignalements(type, signalements) {
        const tableBody = document.querySelector(`#tab-${type}`);
        
        if (!tableBody) {
            console.error(`Le tableau pour le type ${type} n'existe pas dans le DOM.`);
            return; 
        }
    
        tableBody.innerHTML = '';
    
        signalements.forEach(signalement => {
            const screenContent = signalement.screen 
                ? `<button class="btn btn-primary" data-id="${signalement.screen}">
                     <i class="bi-info-circle"></i> Télécharger l'image
                   </button>` 
                : `<span>Aucune pièce jointe</span>`;
    
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${signalement.id}</td>
                <td>${signalement.date}</td>
                <td>${signalement.content}</td>
                <td>${screenContent}</td>
                <td><button class="btn btn-warning" onclick="resolveReporting(${signalement.id}, 'resolve')" data-id="${signalement.id}">
                    <i class="bi-shield-exclamation"></i> Résoudre</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
    

    async function fetchSignalements(type) {
        try {
            const url = `/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APISignal.php?type=${type}`;
            console.log('URL de l\'API :', url);

            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`Erreur lors de l'appel de l'API : ${response.status} ${response.statusText}`);
            }

            const data = await response.json();  

            if (data.success) {
                displaySignalements(type, data.data);
            } else {
                console.error("Erreur lors de la récupération des signalements :", data.error);
            }
        } catch (error) {
            console.error("Erreur lors de l'appel de l'API :", error);
        }
    }

    const types = {
        'chat': 1,
        'forum': 2,
        'chatbot': 3,
        'users': 4,
        'events': 5,
        'faq': 6
    };

    for (const [type, id] of Object.entries(types)) {
        const table = document.querySelector(`#faqsOne-${id}`);
        if (table) {
            fetchSignalements(id);
        } else {
            console.warn(`Le tableau pour le type ${type} (id faqsOne-${id}) est manquant.`);
        }
    }

    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('btn-primary')) {
            const signalementId = event.target.getAttribute('data-id');
            alert("Signalement " + signalementId + " résolu !");
        }
    });
});

async function resolveReporting(signalementId, action) {
    try {
        const response = await fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APISignal.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                id: signalementId,
                action: action
            })
        });

        const rawData = await response.text();
        console.log("Réponse brute du serveur : ", rawData);

        let data;
        try {
            data = JSON.parse(rawData);
        } catch (e) {
            console.error("Erreur de parsing JSON", e);
            return;
        }

        if (data.success) {
            console.log("Signalement résolu avec succès :", data.message);
            alert("Signalement résolu !");
        } else {
            console.error("Erreur lors de la résolution du signalement:", data.error);
        }
    } catch (error) {
        console.error("Erreur lors de la requête:", error);
    }
}


function sendReporting(id, action) {
    fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/APISignal.php', {
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
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(error => console.error('Erreur lors de l\'envoi du signalement:', error));
}

