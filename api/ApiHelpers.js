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
        switch (data.role) {
          case 'admin':
            window.location.href = '/Projet-Annuel-2i1/PA2i1/views/admin/home.php';
            break;
          case 'clients':
            window.location.href = '/Projet-Annuel-2i1/PA2i1/views/clients/home.php';
            break;
          case 'employees':
            window.location.href = '/Projet-Annuel-2i1/PA2i1/views/employees/home.php';
            break;
          case 'providers':
            window.location.href = '/Projet-Annuel-2i1/PA2i1/views/providers/home.php';
            break;
          
          default:
            window.location.href = '/Projet-Annuel-2i1/PA2i1/views/index.php';
        }
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      document.getElementById('wrong').innerText = 'Erreur lors de la connexion. Essayez à nouveau.';
    });
  }
  