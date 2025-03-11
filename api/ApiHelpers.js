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
  .then(response => response.json().then(data => ({ status: response.status, body: data })))
  .then(({ status, body }) => {
    if (status !== 200) {
      document.getElementById('wrong').innerText = body.error || 'Erreur inconnue.';
      return;
    }

    switch (body.role) {
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
  })
  .catch(error => {
    console.error('Erreur:', error);
    document.getElementById('wrong').innerText = 'Erreur lors de la connexion. Essayez à nouveau.';
  });
}

function resetPassword(event) {
  event.preventDefault();

  var email = document.getElementById('inputEmail').value;
  var password1 = document.getElementById('inputPwd').value;
  var password2 = document.getElementById('inputPwdConfirm').value;

  if (password1 !== password2) {
    document.getElementById('wrong').innerText = 'Les mots de passe ne correspondent pas.';
    return;
  }

  fetch('/Projet-Annuel-2i1/PA2i1/api/ApiResetPassword.php', { 
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      email: email,
      newPassword: password1
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // document.getElementById('wrong').innerText = 'Mot de passe réinitialisé avec succès.';
      window.location.href = '/Projet-Annuel-2i1/PA2i1/views/login.php';
    } else {
      document.getElementById('wrong').innerText = data.error || 'Erreur inconnue.';
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    document.getElementById('wrong').innerText = 'Erreur lors de la réinitialisation du mot de passe. Essayez à nouveau.';
  });
}
