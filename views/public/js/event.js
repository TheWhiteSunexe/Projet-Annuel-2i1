document.addEventListener("DOMContentLoaded", function() {
  const datesApiUrl = `/Projet-Annuel-2i1/PA2i1/api/ApiDate.php`;
  const eventsApiUrl = `/Projet-Annuel-2i1/PA2i1/api/ApiEvent.php`;

  fetch(datesApiUrl)
      .then(response => response.json())
      .then(dates => {
          const navTabs = document.getElementById('eventDateTabs');
          navTabs.innerHTML = "";
          if (dates.length === 0) {
              navTabs.innerHTML = `<li class="nav-item"><span>Aucune date trouvée</span></li>`;
              return;
          }

          dates.forEach((date, index) => {
              let displayDate = new Date(date).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' });
              let formattedDate = new Date(date).toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/\//g, '');
              let activeClass = index === 0 ? "active" : "";
              navTabs.innerHTML += `
                  <li class="nav-item" role="presentation">
                      <a class="nav-link ${activeClass}" id="tab-${index}" data-toggle="pill" href="#${formattedDate}" role="tab" aria-selected="${index === 0}">${displayDate}</a>
                  </li>
              `;
          });
      })
      .catch(error => console.error("Erreur lors du chargement des dates :", error));

  fetch(eventsApiUrl)
      .then(response => response.json())
      .then(events => {
          const eventDetailsContainer = document.getElementById('eventDetailsContainer');
          eventDetailsContainer.innerHTML = "";

          if (events.length === 0) {
              eventDetailsContainer.innerHTML = "<p>Aucun évènement trouvé.</p>";
              return;
          }

          const groupedEvents = {};
          events.forEach(event => {
              let formattedDate = new Date(event.date).toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/\//g, '');
              if (!groupedEvents[formattedDate]) {
                  groupedEvents[formattedDate] = [];
              }
              groupedEvents[formattedDate].push(event);
          });

          for (const date in groupedEvents) {
            let pane = document.createElement('div');
            pane.classList.add('tab-pane', 'fade', 'active', 'show');
            pane.id = date;
            

              let row = document.createElement('div');
              row.classList.add('row');

              groupedEvents[date].forEach(event => {
                  let startTime = new Date(`1970-01-01T${event.start_hour}`).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                  let endTime = new Date(`1970-01-01T${event.end_hour}`).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                  let eventDate = new Date(event.date).toLocaleDateString('fr-FR');
                  row.innerHTML += `
                  <br>
                  <div style="border: 1px solid grey; border-radius: 10px; box-shadow: 2px 2px 8px rgba(0,0,0,0.2); padding: 16px; margin: 16px; width : 500px;">
                      <div>
                          <div class="single-schedules-inner">
                              <div class="date">
                                  <i class="fa fa-clock-o"></i>
                                  ${startTime} - ${endTime} &emsp; ${eventDate}
                              </div>
                              <h5>${event.title}</h5>
                              <h5>Animé par : ${event.firstname} ${event.name}</h5>
                              <p>${event.description}</p>
                              <div class="media-right align-self-center">
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#${event.id}"><i class="bi bi-info-circle"></i> 
                                        Lieu
                                      </button>
                                  </div>
                              <div class="media">
                                  <div class="media-left">
                                      <!-- Boutons de réservation -->
                                      <br>
                                      <button type="button" class="btn btn-success" onclick="handleReservation(${event.id}, 'follow')"><i class="bi bi-check-circle"></i> Réservation</button>
                                      <button type="button" class="btn btn-danger" onclick="handleDesinscription(${event.id}, 'unfollow')"><i class="bi bi-ban"></i> Désinscription</button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="modal fade" id="${event.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">${event.title}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="modal-text">Lieu pour l'évènement :</h6>
                                <h6 class="modal-text">${event.address}, ${event.postal_code}</h6>
                                <h6 class="modal-text">${event.city}, ${event.country}</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <br>
                  `;
              });
              pane.appendChild(row);
              eventDetailsContainer.appendChild(pane);
          }
      })
      .catch(error => console.error("Erreur lors du chargement des évènements :", error));
});

function handleReservation(eventId) {
    fetch(`/Projet-Annuel-2i1/PA2i1/api/ApiEvent.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: eventId, action: 'follow' })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Réservation confirmée !');
      } else {
        alert('Erreur lors de la réservation : ' + data.message);
      }
    })
    .catch(error => {
      console.error('Erreur API:', error);
      alert('Une erreur est survenue.');
    });
  }
  
  function handleDesinscription(eventId) {
    fetch(`/Projet-Annuel-2i1/PA2i1/api/ApiEvent.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: eventId, action: 'unfollow' })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Désinscription effectuée.');
      } else {
        alert('Erreur lors de la désinscription : ' + data.message);
      }
    })
    .catch(error => {
      console.error('Erreur API:', error);
      alert('Une erreur est survenue.');
    });
  }
  
