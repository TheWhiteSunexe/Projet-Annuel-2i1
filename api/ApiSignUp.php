<?php

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/SignUpDAO.php';

if (!isset($_GET['type'])) {
    echo json_encode(['success' => false, 'error' => 'Le type d\'inscription est requis.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['type'] === 'client') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset(
        $inputData['company_name_client'], 
        $inputData['siret_number_client'], 
        $inputData['legal_form_client'], 
        $inputData['activity_sector_client'], 

        $inputData['representative_lastname_client'], 
        $inputData['representative_firstname_client'], 
        $inputData['contact_email_client'], 
        $inputData['contact_phone_client'], 

        $inputData['company_website_client'], 

        $inputData['billing_address_client'], 
        $inputData['postal_code_client'], 
        $inputData['country_client'], 

        $inputData['password_client'], 
        $inputData['confirm_password_client']
    )) {

        $name = $inputData['representative_lastname_client'];
        $firstname = $inputData['representative_firstname_client'];

        $company_name = $inputData['company_name_client'];
        $activity_sector = $inputData['activity_sector_client'];
        $legal_form = $inputData['legal_form_client'];
        $siret = $inputData['siret_number_client']; 

        $country = $inputData['country_client'];
        $address = $inputData['billing_address_client'];
        $postal_code = $inputData['postal_code_client'];

        $phone = $inputData['contact_phone_client'];
        $email = $inputData['contact_email_client'];

        $link = $inputData['company_website_client'];


        if (UserDAO::emailExists($email)) {
            echo json_encode(['success' => false, 'error' => 'Cet email est déjà utilisé.']);
            exit;
        }

        $password_hashed = hash('sha512', trim($inputData['password_client']));
        
        $updateSuccess = UserDAO::createClient(
            $company_name, 
            $siret, 
            $legal_form, 
            $activity_sector, 
            $name, 
            $firstname, 
            $email, 
            $phone, 
            $link, 
            $address, 
            $postal_code, 
            $country, 
            $password_hashed
        );
        
        if ($updateSuccess) {
            echo json_encode(['success' => true, 'message' => 'Client créé avec succès.'.$updateSuccess.'']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Échec de la création du client.']);
        }

        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Données manquantes dans la requête.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['type'] === 'provider') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset(
        $inputData['lastname_provider'], 
        $inputData['firstname_provider'], 
        $inputData['email_provider'], 
        $inputData['phone_provider'], 

        $inputData['service_type_provider'], 
        $inputData['service_description_provider'], 
        $inputData['company_name_provider'], 
        $inputData['siret_provider'], 
        $inputData['vat_number_provider'], 
        $inputData['website_provider'], 

        $inputData['billing_address_provider'], 
        $inputData['postal_code_provider'], 
        $inputData['country_provider'], 

        $inputData['password_provider'],
        $inputData['confirm_password_provider']
    )) {

        $name = $inputData['lastname_provider'];
        $firstname = $inputData['firstname_provider'];

        $company_name = $inputData['company_name_provider'];
        $service_type = $inputData['service_type_provider'];
        $service_description = $inputData['service_description_provider'];
        $siret = $inputData['siret_provider']; 
        $vat = $inputData['vat_number_provider']; 

        $country = $inputData['country_provider'];
        $address = $inputData['billing_address_provider'];
        $postal_code = $inputData['postal_code_provider'];

        $phone = $inputData['phone_provider'];
        $email = $inputData['email_provider'];

        $link = $inputData['website_provider'];
        

        if (UserDAO::emailExists($email)) {
            echo json_encode(['success' => false, 'error' => 'Cet email est déjà utilisé.']);
            exit;
        }

        $password_hashed = hash('sha512', trim($inputData['password_provider']));
        
        $updateSuccess = UserDAO::createProvider(
            $name, 
            $firstname, 
            $email, 
            $phone, 
            $service_type, 
            $service_description, 
            $address, 
            $postal_code, 
            $country, 
            $company_name, 
            $siret, 
            $vat, 
            $link,
            $password_hashed
        );
        
        if ($updateSuccess) {
            echo json_encode(['success' => true, 'message' => 'Provider créé avec succès.'.$updateSuccess.'']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Échec de la création du provider.']);
        }

        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Données manquantes dans la requête provider.']);
    }
}
?>
