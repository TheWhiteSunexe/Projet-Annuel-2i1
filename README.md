# PA2i1
Repository du projet annuel de 2e année 


Au niveau de la structure du projet:

View, pour les parties visibles des utilisateurs
Controllers, pour gérer les actions des utilisateurs, a voir comment l'inclure dans le projet (si nécéssaire)
Model, règles logique métier, comme les données ou les règles de gestion (à voir aussi ce qu'il y a rééllement dedans)
Api, Fournit des services externes ou des fonctionnalités en ligne
Dao, Utilisation CRUD communqiue avec la base de donnée

Exemple: si un user envoie le form de login 

Vue : Affiche le formulaire de connexion et les erreurs éventuelles.
Contrôleur : Gère la soumission du formulaire, appelle le modèle pour vérifier les informations.
Modèle : Vérifie les informations dans la base de données via le DAO ou en appelant une API externe.
DAO : Interagit avec la base de données pour récupérer les données utilisateur.
API : Si nécessaire, une API externe valide les informations d'authentification et renvoie une réponse (par exemple, un token).

formulaire envoyé via loginToApi(event)
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
Avec l'api :
$data = getBody();

if (!verifyMandatoryParams($data, ['username', 'password'])) {
    returnError(400, 'Mandatory parameters : username, password');
}

$username = trim($data['username']);
$password = trim($data['password']);
$passwordHashed = hash('sha512', $password);

$users = findUsersByCredentials($username, $passwordHashed);
if (!$users) {
    returnError(401, 'Invalid credentials');
}
$usersId = $users['id'];

$token = date('d/M/Y h:m:s') . '_' . $usersId . '_' . generateRandomString(100);
$tokenHashed = hash('md5', $token);

$res = setUsersSession($usersId, $tokenHashed);
if (!$res) {
    returnError(500, 'An error has occurred');
}

returnSuccess(
    [
        'token' => $tokenHashed,
        'date' => date_add(
            date_create(),
            DateInterval::createFromDateString('1 hour')
        )
    ]
);
et le dao :
function findUsersByCredentials($username, $password) {
    $connection = getDatabaseConnection();
    $sql = "SELECT id FROM users WHERE username = :username AND password = :password";
    $query = $connection->prepare($sql);
    $res = $query->execute([
        'username' => $username,
        'password' => $password
    ]);
    if ($res) {
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}
