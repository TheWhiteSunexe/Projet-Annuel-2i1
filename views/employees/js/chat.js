function sendMessage() {
    let content = document.getElementById('message-content').value;
    let conversationId = new URLSearchParams(window.location.search).get('id'); 
    let userId = document.getElementById('user-id').value;

    if (!content.trim()) {
        alert("Le message ne peut pas être vide !");
        return;
    }
    console.log("Données envoyées :", { conversationId, userId, content });
    fetch('/Projet-Annuel-2i1/PA2i1/api/APIChat.php?action=sendMessage', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ conversationId, userId, content })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Réponse du serveur :", data); 
        if (data.success) {
            document.getElementById('message-content').value = ''; 
            fetchMessages(conversationId);
        } else {
            alert('Erreur lors de l\'envoi du message');
        }
    })
    .catch(error => console.error("Erreur lors de l'envoi du message :", error));
}

function fetchMessages(conversationId) {
    fetch(`/Projet-Annuel-2i1/PA2i1/api/APIChat.php?action=getMessages&conversationId=${conversationId}`)
        .then(response => response.json())
        .then(messages => {
            let chatContainer = document.getElementById("chat-messages");
            chatContainer.innerHTML = ""; 
            let currentUserId = document.getElementById('user-id').value; 

            messages.forEach(msg => {
                let messageHTML = formatMessage(msg, currentUserId);
                chatContainer.innerHTML += messageHTML;
            });
        })
        // .catch(error => console.error("Erreur lors de la récupération des messages :", error));
        fetchChatTitle(conversationId);
}

function formatMessage(msg, currentUserId) {
    let date = new Date(msg.date_creation);
    let formattedDate = date.toLocaleString("fr-FR", { day: "2-digit", month: "2-digit", year: "numeric", hour: "2-digit", minute: "2-digit" });

    let userImage = msg.image ? `/Projet-Annuel-2i1/PA2i1/uploads/${msg.image}` : "/Projet-Annuel-2i1/PA2i1/uploads/default.jpg";
    let isCurrentUser = msg.utilisateur_id == currentUserId;

    return `
        <div class="chat-message-${isCurrentUser ? 'right' : 'left'} pb-4">
            <div>
                <img src="${userImage}" class="rounded-circle mr-1" width="40" height="40">
                <div class="text-muted small text-nowrap mt-2">${formattedDate}</div>
            </div>
            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ${isCurrentUser ? 'mr-3' : 'ml-3'}">
                <div class="font-weight-bold mb-1">${isCurrentUser ? 'You' : msg.name + ' ' + msg.firstname}</div>
                ${msg.contenu}
            </div>
        </div>
    `;
}

document.addEventListener("DOMContentLoaded", () => {
    let conversationId = new URLSearchParams(window.location.search).get('id');
    fetchMessages(conversationId);
});

function fetchChatTitle(conversationId) {
    fetch(`/Projet-Annuel-2i1/PA2i1/api/APIChat.php?action=getChatTitle&conversationId=${conversationId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("chat-title").innerText = data.title;
            } else {
                console.error("Erreur lors de la récupération du titre");
            }
        })
        .catch(error => console.error("Erreur :", error));
}
