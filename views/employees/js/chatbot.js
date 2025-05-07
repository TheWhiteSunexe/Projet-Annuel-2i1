const arborescence = {
    "Question 1": {
        _réponse: "Ceci est une info sur Question 1.",
        "Question 1a": {
            _réponse: "Détail de 1a...",
            "Question 1a1": "Réponse finale à 1a1"
        },
        "Question 1b": "Réponse directe à 1b"
    },
    "Question 2": {
        _réponse: async () => {
            const res = await fetch("https://dummyjson.com/users/1");
            const user = await res.json();
            return `Bienvenue ${user.firstName}`;
        },
        "Question 2a": {
            _réponse: "Suite de Question 2a...",
            "Question 2a1": "Fin de la branche 2a1"
        }
    }
};


let path = [];

document.addEventListener("DOMContentLoaded", () => {
    renderOptions(arborescence);
});

function renderOptions(obj) {
    const select = document.getElementById("question-select");
    select.innerHTML = `<option value="">Choisissez...</option>`;

    for (let key in obj) {
        if (key !== "_réponse") {
            const opt = document.createElement("option");
            opt.value = key;
            opt.textContent = key;
            select.appendChild(opt);
        }
    }

    select.onchange = async () => {
        const value = select.value;
        if (!value) return;

        path.push(value);
        let current = arborescence;
        for (let step of path) current = current[step];

        // Afficher la réponse intermédiaire si elle existe
        if (current._réponse) {
            const reply = typeof current._réponse === 'function'
                ? await current._réponse()
                : current._réponse;
            displayMessage(path.join(" > "), reply);
        }

        // Si c'est une réponse finale (string ou fonction), on répond et on reset
        if (typeof current === "string" || typeof current === "function") {
            const reply = typeof current === 'function'
                ? await current()
                : current;
            displayMessage(path.join(" > "), reply);
            path = [];
            renderOptions(arborescence);
        } else {
            renderOptions(current); // continuer vers sous-questions
        }
    };
}

function displayMessage(question, answer) {
    const messages = document.getElementById("chat-messages");
    messages.innerHTML += `<li><strong>Vous :</strong> ${question}</li>`;
    messages.innerHTML += `<li><strong>Bot :</strong> ${answer}</li>`;
}

document.addEventListener("DOMContentLoaded", () => {
    const select = document.getElementById("question-select");
    const messages = document.getElementById("chat-messages");

    // Remplir les catégories
    for (let cat in arborescence) {
        const opt = document.createElement("option");
        opt.value = cat;
        opt.textContent = cat;
        select.appendChild(opt);
    }

    select.addEventListener("change", () => {
        const selectedCat = select.value;
        if (!arborescence[selectedCat]) return;

        select.innerHTML = `<option value="">Choisissez une question...</option>`;
        for (let sub in arborescence[selectedCat]) {
            const opt = document.createElement("option");
            opt.value = `${selectedCat}::${sub}`;
            opt.textContent = sub;
            select.appendChild(opt);
        }
    });
});

async function sendMessage() {
    const select = document.getElementById("question-select");
    const value = select.value;
    if (!value.includes("::")) return;

    const [cat, sub] = value.split("::");
    const response = arborescence[cat][sub];

    const messages = document.getElementById("chat-messages");
    messages.innerHTML += `<li>Vous : ${sub}</li>`;

    let reply = typeof response === 'function' ? await response() : response;
    messages.innerHTML += `<li>Bot : ${reply}</li>`;
}