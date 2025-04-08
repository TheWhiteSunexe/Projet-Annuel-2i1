document.getElementById('signupForm-client').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const formData = {
      company_name_client: document.getElementById('company_name-client').value,
      siret_number_client: document.getElementById('siret_number-client').value,
      legal_form_client: document.getElementById('legal_form-client').value,
      activity_sector_client: document.getElementById('activity_sector-client').value,

      representative_lastname_client: document.getElementById('representative_lastname-client').value,
      representative_firstname_client: document.getElementById('representative_firstname-client').value,
      contact_email_client: document.getElementById('contact_email-client').value,
      contact_phone_client: document.getElementById('contact_phone-client').value,

      company_website_client: document.getElementById('company_website-client').value,

      billing_address_client: document.getElementById('billing_address-client').value,
      postal_code_client: document.getElementById('postal_code-client').value,
      country_client: document.getElementById('country-client').value,

      password_client: document.getElementById('password-client').value,
      confirm_password_client: document.getElementById('confirm_password-client').value
    };
  
    if (formData.password_client !== formData.confirm_password_client) {
      document.getElementById('error_message').innerText = "Les mots de passe ne correspondent pas.";
      return;
    }
  
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiSignUp.php?type=client', {  
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
  