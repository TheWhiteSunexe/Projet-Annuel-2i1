function getEvents() {
    return fetch('/Projet-Annuel-2i1/PA2i1/api/ApiCalendar.php')
        .then(response => response.json())
        .catch(error => {
            console.error("Erreur lors du chargement des événements :", error);
            return []; 
        });
}

document.addEventListener('DOMContentLoaded', async function () {
    var calendarEl = document.getElementById('calendar');

    var events = await getEvents();
    console.log("Événements chargés :", events);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        defaultDate: '2025-01-30', 
        editable: true,
        eventLimit: true, 
        events: events 
    });

    calendar.render();
});
