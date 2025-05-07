<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DAOUser {
    public static function getEmployeesById($userId) {
        try {
            $pdo = getDatabaseConnection();
            $query = "SELECT u.name, u.firstname, u.email, e.phone, e.link, c.name AS company_name
                      FROM users u INNER JOIN employees e ON e.id_users = u.id INNER JOIN clients c ON c.id = e.id_enterprise
                      WHERE u.id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur DAO : " . $e->getMessage();
        }
    }
    public static function getClientsById($userId) {
        try {
            $pdo = getDatabaseConnection();
            $query = "SELECT u.name, u.firstname, u.email, c.name AS company_name, c.siret, c.phone, c.legal_form, c.activity_sector, c.address, c.postal_code, c.country, c.link, c.description
                      FROM users u Inner join clients c On u.id = c.id_user
                      WHERE u.id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur DAO : " . $e->getMessage();
        }
    }
    public static function getProvidersById($userId) {
        try {
            $pdo = getDatabaseConnection();
            $query = "SELECT u.name, u.firstname, u.email, p.company_name, p.siret, p.phone, p.service_type, p.service_description, p.address, p.postal_code, p.country, p.vat_number, p.link
                      FROM users u Inner join providers p On u.id = p.user_id
                      WHERE u.id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur DAO : " . $e->getMessage();
        }
    }
    public static function checkStatutProvider($userId) {
        try {
            $pdo = getDatabaseConnection();
            $query = "SELECT statut FROM providers
                      WHERE user_id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur DAO : " . $e->getMessage();
        }
    }
    public static function updateUserImage($userId, $imageUrl) {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE users SET image = ? WHERE id = ?");
        return $stmt->execute([$imageUrl, $userId]);
    }

    public static function deleteUserImage($userId) {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE users SET image = NULL WHERE id = ?");
        return $stmt->execute([$userId]);
    }
    public static function deleteUser($userId) {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE users SET active = 0 WHERE id = ?");
        return $stmt->execute([$userId]);
    }
    public static function updateEmployees($userId, $phone, $linkedin) {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE employees SET phone = ?, link = ? WHERE id_users = ?");
        return $stmt->execute([ $phone, $linkedin, $userId]);
    }
    public static function updateClients($userId, $name, $firstname, $company_name, $description, $activity_sector, $legal_form, $siret, $country, $address, $postal_code, $phone, $email, $link) {
        $pdo = getDatabaseConnection();
        
        $stmt = $pdo->prepare(
            "UPDATE clients c
            INNER JOIN users u ON c.id_user = u.id 
            SET u.name = :name, 
                u.firstname = :firstname, 
                u.email = :email, 
                c.phone = :phone, 
                c.description = :description, 
                c.activity_sector = :activity_sector, 
                c.legal_form = :legal_form, 
                c.name = :company_name, 
                c.siret = :siret, 
                c.country = :country, 
                c.address = :address, 
                c.postal_code = :postal_code, 
                c.link = :link 
            WHERE u.id = :userId"
        );
    
        // Bind les paramètres à la requête
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':activity_sector', $activity_sector, PDO::PARAM_STR);
        $stmt->bindParam(':legal_form', $legal_form, PDO::PARAM_STR);
        $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
        $stmt->bindParam(':siret', $siret, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);
    
        try {
            if ($stmt->execute()) {
                return json_encode(["success" => true]);
            } else {
                return json_encode(["success" => false, "error" => "Échec de l'exécution de la requête."]);
            }
        } catch (PDOException $e) {
            return json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    }
    public static function updateProviders($userId, $name, $firstname, $service_type, $service_description, $company, $siret, $vat_number, $country, $address, $postal_code, $phone, $email, $link) {
        $pdo = getDatabaseConnection();
        
        $stmt = $pdo->prepare(
            "UPDATE providers p 
            INNER JOIN users u ON p.user_id = u.id 
            SET u.name = :name, 
                u.firstname = :firstname, 
                u.email = :email, 
                p.phone = :phone, 
                p.service_type = :service_type, 
                p.service_description = :service_description, 
                p.company_name = :company, 
                p.siret = :siret, 
                p.vat_number = :vat_number, 
                p.country = :country, 
                p.address = :address, 
                p.postal_code = :postal_code, 
                p.link = :link 
            WHERE u.id = :userId"
        );
    
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
        $stmt->bindParam(':service_description', $service_description, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':siret', $siret, PDO::PARAM_STR);
        $stmt->bindParam(':vat_number', $vat_number, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);
    
        try {
            if ($stmt->execute()) {
                return json_encode(["success" => true]);
            } else {
                return json_encode(["success" => false, "error" => "Échec de l'exécution de la requête."]);
            }
        } catch (PDOException $e) {
            return json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    }
    
    
}
?>
