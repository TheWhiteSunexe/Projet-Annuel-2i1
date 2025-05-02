<?php
$title = $_POST['title'];
$message = $_POST['message'];

$fields = [
    'app_id' => '5ef3a540-a864-4902-9cca-fe6a39fe80f5', 
    'included_segments' => ['All'], 
    'headings' => ['en' => $title],  
    'contents' => ['en' => $message],  
];

$fields = json_encode($fields);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json; charset=utf-8',
    'Authorization: 5ef3a540-a864-4902-9cca-fe6a39fe80f5' 
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Erreur cURL: ' . curl_error($ch);
} else {
    $response_data = json_decode($response, true); 
    if(isset($response_data['errors'])) {
        echo 'Erreur API OneSignal: ' . implode(', ', $response_data['errors']);
    } else {
        echo "Notification envoyée avec succès !";
    }
}

curl_close($ch);

header('Location: /Projet-Annuel-2i1/PA2i1/views/admin/back/OneSignal.php');
exit();
?>
