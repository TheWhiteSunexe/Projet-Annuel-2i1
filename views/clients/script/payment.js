const stripe = Stripe('pk_test_51Qn1TEF9UK6PhOmTjvDNhWuXTIG2yvOPeVszJOFtKxPZlexybMKVqjQ614mFaRv12B1ldjljU5ayyBUDm8J7rkuP00KfmSEiNl');  // Remplace par ta clé publique Stripe
const elements = stripe.elements();

const card = elements.create('card'); // Crée le champ pour la carte

card.mount('#card-element'); // Attache-le à l'élément HTML de ton formulaire

// Affichage des erreurs dans le champ
card.addEventListener('change', function(event) {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Lors de la soumission du formulaire
const form = document.getElementById('payment-form');
form.addEventListener('submit', async function(event) {
    event.preventDefault();

    const {token, error} = await stripe.createToken(card);

    // Vérifie si une erreur est survenue lors de la création du token
    if (error) {
        console.log('Erreur lors de la création du token :', error.message);
    } else {
        console.log('Token généré avec succès :', token.id);
        stripeTokenHandler(token);
    }
});

function stripeTokenHandler(token) {
    const form = document.getElementById('payment-form');

    // Crée un champ caché pour envoyer le token au backend
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Vérifie que le token est bien attaché au formulaire avant soumission
    console.log('Token envoyé dans le formulaire :', hiddenInput);

    form.submit();
}

