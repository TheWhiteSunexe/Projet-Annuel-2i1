document.getElementById('signupForm').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const formData = {
      company_name: document.getElementById('company_name').value,
      siret_number: document.getElementById('siret_number').value,
      legal_form: document.getElementById('legal_form').value,
      activity_sector: document.getElementById('activity_sector').value,
      representative_lastname: document.getElementById('representative_lastname').value,
      representative_firstname: document.getElementById('representative_firstname').value,
      contact_email: document.getElementById('contact_email').value,
      contact_phone: document.getElementById('contact_phone').value,
      company_website: document.getElementById('company_website').value,
      billing_address: document.getElementById('billing_address').value,
      postal_code: document.getElementById('postal_code').value,
      country: document.getElementById('country').value,
      password: document.getElementById('password').value,
      confirm_password: document.getElementById('confirm_password').value
    };
  
    if (formData.password !== formData.confirm_password) {
      document.getElementById('error_message').innerText = "Les mots de passe ne correspondent pas.";
      return;
    }
  
    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiSignUp.php', {  
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
  