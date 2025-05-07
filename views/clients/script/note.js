document.addEventListener("DOMContentLoaded", () => {
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiNote.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('note-full-container');
            container.innerHTML = '';
            if (data.success && data.notes.length > 0) {
                data.notes.forEach(note => {
                    const isFav = note.fav == 1;
                    const favClass = isFav ? 'note-favourite' : '';
                    const starColor = isFav ? 'gold' : 'black';

                    const noteHTML = `
                        <div class="col-md-4 single-note-item all-category note-important ${favClass}" data-id="${note.id}">
                            <div class="card card-body" style="width: auto;">
                                <span class="side-stick"></span>
                                <h5 class="note-title text-truncate w-75 mb-0" data-noteheading="${note.title}">
                                    ${note.title}
                                </h5>
                                <p class="note-date font-12 text-muted">${note.created_at}</p>
                                <div class="note-content">
                                    <p class="note-inner-content text-muted" data-notecontent="${note.content}">
                                        ${note.content}
                                    </p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="mr-1">
                                        <a class="toggle-fav" style="color: ${starColor}" href="#" data-id="${note.id}" data-fav="${note.fav}">
                                            <i class="fa ${isFav ? 'fa-solid' : 'fa-regular'} fa-star favourite-note"></i>
                                        </a>
                                    </span>
                                    <span class="mr-1">
                                        <a class="delete-note" style="color: black" href="#" data-id="${note.id}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>`;
                    container.innerHTML += noteHTML;
                });

                initNoteEvents();
            } else {
                container.innerHTML = "<p>Aucune note trouvée.</p>";
            }
        })
        .catch(err => {
            console.error("Erreur de récupération des notes :", err);
        });
});

function initNoteEvents() {
    const favLinks = document.querySelectorAll(".toggle-fav");
    favLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const noteId = this.dataset.id;
            const currentFav = parseInt(this.dataset.fav);
            const newFav = currentFav === 1 ? 0 : 1;

            fetch('/Projet-Annuel-2i1/PA2i1/api/ApiNote.php?action=fav', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${noteId}&fav=${newFav}`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.dataset.fav = newFav;
                        const icon = this.querySelector('i');
                        icon.classList.toggle('fa-solid', newFav === 1);
                        icon.classList.toggle('fa-regular', newFav === 0);
                        this.style.color = newFav === 1 ? 'gold' : 'black';
                    } else {
                        alert("Erreur lors de la mise à jour du favori.");
                    }
                })
                .catch(() => alert("Erreur réseau."));
        });
    });

    const deleteLinks = document.querySelectorAll(".delete-note");
    deleteLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const noteId = this.dataset.id;
            if (!confirm("Êtes-vous sûr de vouloir supprimer cette note ?")) return;

            fetch('/Projet-Annuel-2i1/PA2i1/api/ApiNote.php?action=delete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${noteId}`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const noteElement = document.querySelector(`.single-note-item[data-id="${noteId}"]`);
                        if (noteElement) noteElement.remove();
                    } else {
                        alert("Erreur lors de la suppression.");
                    }
                })
                .catch(() => alert("Erreur réseau."));
        });
    });
}
