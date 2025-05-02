<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';


function setUsersSession ($id, $token) {
    $connection = getDatabaseConnection();
    $sql = "UPDATE users SET token = :token, expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = :id";
    $query = $connection->prepare($sql);
    $res = $query->execute([
        'id' => $id,
        'token' => $token
    ]);
    if ($res) {
        return $query->rowCount();
    }
    return null;
}

function validateToken($token) {
    $connection = getDatabaseConnection();

        $sql = "SELECT id, token, expiration FROM users WHERE token = :token";
        $query = $connection->prepare($sql);
        $res = $query->execute([
            'token' => $token
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }
        $currentDateTime = new DateTime();
        $expirationDateTime = new DateTime($result['expiration']);
        if ($currentDateTime > $expirationDateTime) {
            return false;
        }
        return [
            "id" => $result['id'],
            "token" => $result['token']
        ];

}

function findUsersByCredentials($username, $password) {
    $connection = getDatabaseConnection();
    $sql = "
        SELECT 
            id, 
            username, 
            name,
            image AS img,
            firstname,
            id_clients,
            id_providers,
            id_admin,
            id_employees,
            expiration,
            active
        FROM users
        WHERE username = :username AND password = :password
    ";

    $query = $connection->prepare($sql);
    $res = $query->execute([
        'username' => $username,
        'password' => $password
    ]);

    if ($res && $user = $query->fetch(PDO::FETCH_ASSOC)) {
        return $user;
    }

    return null;
}


function ClientVerifySubscription($id) {
    $connection = getDatabaseConnection();
    $sql = "
        SELECT 
            subscription,
            exp_date
            FROM clients
            WHERE id_user = :id
        ";

    $query = $connection->prepare($sql);
    $res = $query->execute([
        'id' => $id
    ]);

    if ($res && $pricing = $query->fetch(PDO::FETCH_ASSOC)) {
        return $pricing;
    }

    return null;
}
function resetPasswordByEmail($email, $Password) {
    $connection = getDatabaseConnection();

    $sql = "UPDATE users SET password = :password WHERE email = :email";
    $query = $connection->prepare($sql);
    
    $res = $query->execute([
        'password' => $Password,
        'email' => $email
    ]);

    return $res;
}


/*function findOneViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT users.id, users.name, users.health, viking.attack, viking.defense, weapon.id AS weaponId, weapon.type AS weapon_type
            FROM viking
            LEFT JOIN weapon ON viking.weaponId = weapon.id
            WHERE viking.id = :id";
    
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    
    if ($res) {
        $viking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($viking['weaponId']) {
            $viking['weapon'] = "/weapons/" . $viking['weaponId'];
        } else {
            $viking['weapon'] = "";
        }
        unset($viking['weaponId'], $viking['weapon_type']);
        return $viking;
    }
    return null;
}

function findAllVikings(string $name = "", int $limit = 10, int $offset = 0) {
    $db = getDatabaseConnection();
    $params = [];
    
    $sql = "SELECT viking.id, viking.name, viking.health, viking.attack, viking.defense, weapon.id AS weaponId, weapon.type AS weapon_type
            FROM viking
            LEFT JOIN weapon ON viking.weaponId = weapon.id";
    
    if ($name) {
        $sql .= " WHERE viking.name LIKE :name";
        $params['name'] = '%' . $name . '%';
    }
    
    $sql .= " LIMIT $limit OFFSET $offset";
    
    $stmt = $db->prepare($sql);
    $res = $stmt->execute($params);
    
    if ($res) {
        $vikings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($vikings as &$viking) {
            if ($viking['weaponId']) {
                $viking['weapon'] = "/weapons/" . $viking['weaponId'];
            } else {
                $viking['weapon'] = "";
            }
            unset($viking['weaponId'], $viking['weapon_type']);
        }
        
        return $vikings;
    }
    
    return null;
}*/

function createUsers(string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "INSERT INTO users (name, health, attack, defense, weaponId) 
            VALUES (:name, :health, :attack, :defense, :weaponId)";
    
    $stmt = $db->prepare($sql);
    $res = $stmt->execute([
        'name' => $name, 
        'health' => $health, 
        'attack' => $attack, 
        'defense' => $defense,
        'weaponId' => $weaponId
    ]);
    
    if ($res) {
        return $db->lastInsertId();
    }
    
    return null;
}

function weaponExists(int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "SELECT 1 FROM weapon WHERE id = :weaponId LIMIT 1";
    
    $stmt = $db->prepare($sql);
    $stmt->execute(['weaponId' => $weaponId]);
    
    return $stmt->rowCount() > 0;
}

function updateUsers(string $id, string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();

    $sql = "UPDATE viking SET name = :name, health = :health, attack = :attack, defense = :defense, weaponId = :weaponId WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute([
        'id' => $id,
        'name' => $name,
        'health' => $health,
        'attack' => $attack,
        'defense' => $defense,
        'weaponId' => $weaponId
    ]);

    if ($res) {
        return $stmt->rowCount();
    }

    return null;
}

function addWeaponToViking(int $viking_id, int $weaponId) {
    $db = getDatabaseConnection();

    $sql = "UPDATE viking SET weaponId = :weaponId WHERE id = :viking_id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute([
        'viking_id' => $viking_id,
        'weaponId' => $weaponId
    ]);

    return $res;
}


function vikingExists(int $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT 1 FROM viking WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount() > 0;
}

function deleteViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "DELETE FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}