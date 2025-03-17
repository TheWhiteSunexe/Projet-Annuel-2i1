<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class UserDAO {

    public static function createClient($company_name, $siret_number, $legal_form, $activity_sector, $representative_lastname, $representative_firstname, $contact_email, $contact_phone, $company_website, $billing_address, $postal_code, $country, $password_hashed) {
        try {
            $connection = getDatabaseConnection();
            $connection->beginTransaction();

            $username = strtolower(substr($representative_firstname, 0, 1) . $representative_lastname);

            $sql_users = "INSERT INTO users (firstname, name, username, email, password) 
                          VALUES (:firstname, :name, :username, :email, :password)";
            $query_users = $connection->prepare($sql_users);
            $query_users->execute([
                'firstname' => $representative_firstname,
                'name' => $representative_lastname,
                'username' => $username,
                'email' => $contact_email,
                'password' => $password_hashed
            ]);

            $user_id = $connection->lastInsertId();

            $sql_clients = "INSERT INTO clients (id_user, name, siret, legal_form, activity_sector, phone, link, address, postal_code, country)
                            VALUES (:id_user, :name, :siret, :legal_form, :activity_sector, :phone, :link, :address, :postal_code, :country)";
            $query_clients = $connection->prepare($sql_clients);
            $query_clients->execute([
                'id_user' => $user_id,
                'name' => $company_name,
                'siret' => $siret_number,
                'legal_form' => $legal_form,
                'activity_sector' => $activity_sector,
                'phone' => $contact_phone,
                'link' => $company_website,
                'address' => $billing_address,
                'postal_code' => $postal_code,
                'country' => $country
            ]);

            $client_id = $connection->lastInsertId();

            $sql_update_user = "UPDATE users SET id_clients = :id_client WHERE id = :user_id";
            $query_update_user = $connection->prepare($sql_update_user);
            $query_update_user->execute([
                'id_client' => $client_id,
                'user_id' => $user_id
            ]);

            $connection->commit();
            return true;

        } catch (PDOException $e) {
            //$connection->rollBack();
            return "Erreur DAO : " . $e->getMessage();
        }
    }

    public static function createProvider($lastname, $firstname, $email, $phone, $service_type, $service_description, $billing_address, $postal_code, $country, $company_name, $siret, $vat_number, $website, $password_hashed) {
        try {
            $connection = getDatabaseConnection();
            $connection->beginTransaction();

            $username = strtolower(substr($firstname, 0, 1) . $lastname);

            $sql_users = "INSERT INTO users (firstname, name, username, email, password) 
                          VALUES (:firstname, :name, :username, :email, :password)";
            $query_users = $connection->prepare($sql_users);
            $query_users->execute([
                'firstname' => $firstname,
                'name' => $lastname,
                'username' => $username,
                'email' => $email,
                'password' => $password_hashed
            ]);

            $user_id = $connection->lastInsertId();

            $sql_providers = "INSERT INTO providers (user_id, phone, service_type, service_description, address, postal_code, country, company_name, siret, vat_number, link)
                              VALUES (:user_id, :phone, :service_type, :service_description, :address, :postal_code, :country, :company_name, :siret, :vat_number, :link)";
            $query_providers = $connection->prepare($sql_providers);
            $query_providers->execute([
                'user_id' => $user_id,
                'phone' => $phone,
                'service_type' => $service_type,
                'service_description' => $service_description,
                'address' => $billing_address,
                'postal_code' => $postal_code,
                'country' => $country,
                'company_name' => $company_name,
                'siret' => $siret,
                'vat_number' => $vat_number,
                'link' => $website
            ]);

            $provider_id = $connection->lastInsertId();

            $sql_update_user = "UPDATE users SET id_providers = :id_provider WHERE id = :user_id";
            $query_update_user = $connection->prepare($sql_update_user);
            $query_update_user->execute([
                'id_provider' => $provider_id,
                'user_id' => $user_id
            ]);

            $connection->commit();
            return true;

        } catch (PDOException $e) {
            // $connection->rollBack();
            return "Erreur DAO : " . $e->getMessage();
        }
    }

    public static function emailExists($email) {
        try {
            $connection = getDatabaseConnection();
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $query = $connection->prepare($sql);
            $query->execute(['email' => $email]);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return false;
        }
    }
}
?>
