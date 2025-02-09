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
              pane.classList.add('tab-pane', 'fade');
              if (Object.keys(groupedEvents)[0] === date) {
                  pane.classList.add('active', 'show');
              }
              pane.id = date;

              let row = document.createElement('div');
              row.classList.add('row');

              groupedEvents[date].forEach(event => {
                  let startTime = new Date(`1970-01-01T${event.start_hour}`).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                  let endTime = new Date(`1970-01-01T${event.end_hour}`).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                  let eventDate = new Date(event.date).toLocaleDateString('fr-FR');
                  row.innerHTML += `
                      <div class="col-lg-4 col-md-6">
                          <div class="single-schedules-inner">
                              <div class="date">
                                  <i class="fa fa-clock-o"></i>
                                  ${startTime} - ${endTime} &emsp; ${eventDate}
                              </div>
                              <h5>${event.title}</h5>
                              <p>${event.description}</p>
                              <div class="media">
                                  <div class="media-body align-self-center">
                                      <h6>nom prenom</h6>
                                      <p>profession</p>
                                  </div>
                                  <div class="media-left">
                                      <!-- Boutons de réservation -->
                                      <button type="button" class="btn btn-primary" onclick="handleReservation(${event.id})">Réservation</button>
                                      <button type="button" class="btn btn-danger" onclick="handleDesinscription(${event.id})">Désinscription</button>
                                      <!-- Bouton de suppression pour modérateurs, si applicable -->
                                      ${ event.moderator === true ? `<button type="button" class="btn btn-danger" onclick="handleSuppression(${event.id})">Supprimer</button>` : "" }
                                  </div>
                              </div>
                          </div>
                      </div>
                  `;
              });
              pane.appendChild(row);
              eventDetailsContainer.appendChild(pane);
          }
      })
      .catch(error => console.error("Erreur lors du chargement des évènements :", error));
});

function handleReservation(eventId) {
  window.location.href = `payement.php?id=${eventId}`;
}

function handleDesinscription(eventId) {
  window.location.href = `payement.php?id=${eventId}&alert=1`;
}

function handleSuppression(eventId) {
  window.location.href = `suppression_resa.php?id=${eventId}`;
}
