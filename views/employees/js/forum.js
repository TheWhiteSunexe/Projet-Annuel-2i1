document.addEventListener('DOMContentLoaded', function() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiForum.php')
        .then(response => response.json())
        .then(topics => {
            let forumContainer = document.getElementById('forum-container');
            forumContainer.innerHTML = ""; 

            if (topics.length === 0) {
                forumContainer.innerHTML = "<p>Aucun sujet disponible.</p>";
                return;
            }

            topics.forEach(topic => {
                let topicElement = document.createElement('div');
                topicElement.classList.add('card', 'mb-3', 'border-success');

                topicElement.innerHTML = `
                <div class="card row-hover pos-relative py-3 px-3 mb-3 border-top-0 border-right-0 border-bottom-0 rounded-0">
                    <div class="row align-items-center py-3 px-3">
                        <div class="col-md-8">
                            <h5>
                                <a href="forumChat.php?id=${topic.message_id}" class="text-primary">${topic.titre}</a>
                                ${topic.contenu ? `<div class="text-muted small">${topic.contenu}</div>` : ''}
                            </h5>
                            <p class="text-sm">
                                <span class="op-6">Posté le</span> 
                                <span class="text-black">${formatDate(topic.date_creation)}</span> 
                                <span class="op-6">par</span> 
                                <span class="text-black">${topic.nom_utilisateur} ${topic.prenom_utilisateur}</span>
                            </p>
                            <div class="text-sm op-5">
                                ${topic.hashtags.map(tag => `<a class="text-black mr-2" href="#">#${tag}</a>`).join(' ')}
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="row">
                                <div class="col px-1">
                                    <i class="ion-ios-chatboxes-outline icon-1x"></i> 
                                    <span class="d-block text-sm">${topic.nb_messages} Réponses</span>
                                </div>
                                <div class="col px-1">
                                    <i class="ion-ios-eye-outline icon-1x"></i> 
                                    <span class="d-block text-sm">${topic.nb_see} Vues</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                forumContainer.appendChild(topicElement);
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement du forum :", error);
            document.getElementById('forum-container').innerHTML = "<p>Erreur de chargement.</p>";
        });
});

function formatDate(dateString) {
    let date = new Date(dateString);
    return date.toLocaleDateString("fr-FR", { year: 'numeric', month: 'long', day: 'numeric' });
}

document.addEventListener('DOMContentLoaded', function() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiForumComments.php')
        .then(response => response.json())
        .then(messages => {
            let messagesContainer = document.getElementById('messages-container');
            messagesContainer.innerHTML = ""; 

            if (messages.length === 0) {
                messagesContainer.innerHTML = "<p>Aucun message trouvé.</p>";
                return;
            }

            messages.forEach(message => {
                let messageElement = document.createElement('div');
                messageElement.classList.add('message-card', 'py-3', 'px-3');

                messageElement.innerHTML = `
                    <hr class="m-0">
                    <div class="pos-relative px-3 py-3">
                        <h6 class="text-primary text-sm">
                            <a href="message.php?id=${message.message_id}" class="text-primary">${message.titre}</a>
                        </h6>
                        <p class="mb-0 text-sm">
                            <span class="op-6">Posté</span> 
                            <span class="text-black">${message.date_formattee}</span> 
                            <span class="op-6">par</span> 
                            <a class="text-black" href="user.php?id=${message.utilisateur_id}">
                                ${message.prenom_utilisateur} ${message.nom_utilisateur}
                            </a>
                        </p>
                    </div>
                `;

                messagesContainer.appendChild(messageElement);
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement des messages :", error);
            document.getElementById('messages-container').innerHTML = "<p>Erreur de chargement.</p>";
        });
});

document.addEventListener('DOMContentLoaded', function() {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiForumStats.php')
        .then(response => response.json())
        .then(stats => {
            let statsContainer = document.getElementById('stats-container');
            statsContainer.innerHTML = ""; 

            statsContainer.innerHTML = `
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#">${stats.total_topics}</a> Sujets </div>
                            <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#">${stats.total_messages}</a> Posts </div>
                        </div>

                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#">${stats.total_users}</a> Membres </div>
                            <div class="col-sm-6 flex-ew text-center py-3 mx-0"> <a class="d-block lead font-weight-bold" href="#">${stats.last_user_name}</a> Dernier membre </div>
                        </div>
            `;
        })
        .catch(error => {
            console.error("Erreur lors du chargement des statistiques :", error);
            document.getElementById('stats-container').innerHTML = "<p>Erreur de chargement.</p>";
        });
});
