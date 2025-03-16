<?php
session_start();
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/UserDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode([
        'success' => false,
        'error' => "Utilisateur non authentifié."
    ]);
    exit;
}

$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'upload') {
    if (!isset($_FILES['profile_image'])) {
        echo json_encode(['success' => false, 'error' => "Aucune image envoyée."]);
        exit;
    }

    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Projet-Annuel-2i1/PA2i1/uploads/";
    $fileName = "profile_" . $_SESSION['id'] . "_" . time() . "." . pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $filePath)) {
        $imageUrl = $fileName;

        DAOUser::updateUserImage($userId, $imageUrl);

        echo json_encode(['success' => true, 'image_url' => $imageUrl]);
    } else {
        echo json_encode(['success' => false, 'error' => "Échec du téléchargement de l'image."]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'delete') {

    $deleteImg = DAOUser::deleteUserImage($userId);
    if($deleteImg){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => "Échec de suppression de l'image."]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update' && $_GET['user'] === 'employees') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);
    
    if (isset( $inputData['phone'], $inputData['linkedin'])) {
        
        if (isset($_SESSION['id'])) {
            $phone = $inputData['phone'];
            $linkedin = $inputData['linkedin'];
            
            $updateSuccess = DAOUser::updateEmployees($userId, $phone, $linkedin);
            
            if ($updateSuccess) {
                echo json_encode(['success' => true, 'message' => 'Les informations ont été mises à jour avec succès.']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Échec de la mise à jour des informations.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté.']);
        }
        
    } else {
        echo json_encode(['success' => false, 'error' => 'Données manquantes dans la requête.']);
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update' && $_GET['user'] === 'providers') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset( $inputData['name'], $inputData['firstname'],  $inputData['service_type'],  $inputData['service_description'],  $inputData['company'],  $inputData['siret'],  $inputData['vat_number'],  $inputData['country'],  $inputData['address'],  $inputData['postal_code'],  $inputData['phone'],  $inputData['email'],  $inputData['link'])) {

        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $name = $inputData['name'];
            $firstname = $inputData['firstname'];
            $service_type = $inputData['service_type'];
            $service_description = $inputData['service_description'];
            $company = $inputData['company'];
            $siret = $inputData['siret'];
            $vat_number = $inputData['vat_number'];
            $country = $inputData['country'];
            $address = $inputData['address'];
            $postal_code = $inputData['postal_code'];
            $phone = $inputData['phone'];
            $email = $inputData['email'];
            $link = $inputData['link'];
            
            $updateSuccess = DAOUser::updateProviders($userId, $name, $firstname, $service_type, $service_description, $company, $siret, $vat_number, $country, $address, $postal_code, $phone, $email, $link);
            
            if ($updateSuccess) {
                echo json_encode(['success' => true, 'message' => 'Les informations du prestataire ont été mises à jour avec succès.']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Échec de la mise à jour des informations du prestataire.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté.']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Données manquantes dans la requête.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update' && $_GET['user'] === 'clients') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset( $inputData['name'], $inputData['firstname'],  $inputData['company_name'],  $inputData['description'],  $inputData['activity_sector'],  $inputData['legal_form'],  $inputData['siret'],  $inputData['country'],  $inputData['address'],  $inputData['postal_code'],  $inputData['phone'],  $inputData['email'],  $inputData['link'])) {

        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $name = $inputData['name'];
            $firstname = $inputData['firstname'];
            $company_name = $inputData['company_name'];
            $description = $inputData['description'];
            $activity_sector = $inputData['activity_sector'];
            $legal_form = $inputData['legal_form'];
            $siret = $inputData['siret']; 
            $country = $inputData['country'];
            $address = $inputData['address'];
            $postal_code = $inputData['postal_code'];
            $phone = $inputData['phone'];
            $email = $inputData['email'];
            $link = $inputData['link'];
            
            $updateSuccess = DAOUser::updateProviders($userId, $name, $firstname, $company_name, $description, $activity_sector, $legal_form, $siret, $country, $address, $postal_code, $phone, $email, $link);
            
            if ($updateSuccess) {
                echo json_encode(['success' => true, 'message' => 'Les informations du prestataire ont été mises à jour avec succès.']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Échec de la mise à jour des informations du prestataire.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté.']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Données manquantes dans la requête.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'deleteAccount') {
     
    if (isset($_SESSION['id'])) {
        
        $updateAccount = DAOUser::deleteUser($userId);
        
        if ($updateAccount) {
            echo json_encode(['success' => true, 'message' => 'Les informations ont été mises à jour avec succès.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Échec de la mise à jour des informations.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté.']);
    }


    exit;
}

if (isset($_GET['user'])){
$userRole = $_GET['user'];
}
if ($userRole == 'employees'){

    $userData = DAOUser::getEmployeesById($userId);

} elseif ($userRole == 'clients'){

    $userData = DAOUser::getClientsById($userId);

} elseif ($userRole == 'providers') {

    $userData = DAOUser::getProvidersById($userId);

}else{

    echo json_encode([
        'success' => false,
        'error' => "Role non trouvé."
    ]);

}


if ($userData) {
    echo json_encode([
        'success' => true,
        'data' => $userData
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => "Utilisateur non trouvé."
    ]);
}
?>
