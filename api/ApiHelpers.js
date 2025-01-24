function loginToApi(event) {
    event.preventDefault();

    var username = document.getElementById('inputLogin').value;
    var password = document.getElementById('inputPwd').value;

    fetch('/Projet-Annuel-2i1/PA2i1/api/ApiLogin.php', { 
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        username: username,
        password: password
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erreur lors de la requête');
      }
      return response.json();
    })
    .then(data => {
      if (data.error) {
        document.getElementById('wrong').innerText = data.error;
      } else {
        window.location.href = '/index.php'; 
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      document.getElementById('wrong').innerText = 'Erreur lors de la connexion. Essayez à nouveau.';
    });
  }
  