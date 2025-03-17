document.getElementById('signupForm-provider').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const formData = {
        lastname_provider: document.getElementById('lastname-provider').value,
        firstname_provider: document.getElementById('firstname-provider').value,
        email_provider: document.getElementById('email-provider').value,
        phone_provider: document.getElementById('phone-provider').value,

        service_type_provider: document.getElementById('service_type-provider').value,
        service_description_provider: document.getElementById('service_description-provider').value,

        billing_address_provider: document.getElementById('billing_address-provider').value,
        postal_code_provider: document.getElementById('postal_code-provider').value,
        country_provider: document.getElementById('country-provider').value,

        company_name_provider: document.getElementById('company_name-provider').value,
        siret_provider: document.getElementById('siret-provider').value,
        vat_number_provider: document.getElementById('vat_number-provider').value,
        website_provider: document.getElementById('website-provider').value,

        password_provider: document.getElementById('password-provider').value,
        confirm_password_provider: document.getElementById('confirm_password-provider').value
    };
  
    if (formData.password_provider !== formData.confirm_password_provider) {
      document.getElementById('error_message').innerText = "Les mots de passe ne correspondent pas.";
      return;
    }
  
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiSignUp.php?type=provider', {  
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.href = '/Projet-Annuel-2i1/PA2i1/views/login.php'; 
      } else {
        document.getElementById('error_message').innerText = data.error || "Une erreur s'est produite.";
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      document.getElementById('error_message').innerText = "Erreur lors de l'inscription au niveau du JS.";
    });
  });
  