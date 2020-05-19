<?php

/*
 * A data handler from the feedback form 
 * that verifies the authenticity of the reCAPTCHA token and, 
 * if confirmed, sends the entered data to the email address
 */

$secret = include ('../../../burrow/reCAPTCHA.php');

// If at least one parameter does not exist
if (!isset($_POST['token'], $secret)) {
    echo 'Что-то пошло не так (Internal error)';
    exit;
}

$token = $_POST['token'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$post_fields = array(
    'secret' => $secret,
    'response' => $token,
);

// Open curl session
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // TRUE для возврата результата в качестве строки
curl_setopt($ch, CURLOPT_POST, true); // TRUE для использования обычного HTTP POST
curl_setopt($ch, CURLOPT_URL, $url); // Загружаемый URL
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Все данные, передаваемые в HTTP POST-запросе
// Writing the json response
$response_json = curl_exec($ch);

// Close curl session
curl_close($ch);

// Decoding json to object
$response = json_decode($response_json);

// If the server has confirmed the authenticity of the token, send an email 
// and inform the js-client about it
if ($response->success == TRUE) {

    $to = "chistowick@yandex.ru";
    $subj = $_POST['subj'] . ' *mrbooks.ru*';
    $message = $_POST['textArea'];
    $headers = 'Content-type: text/plain;';

    if (mail($to, $subj, $message, $headers)) {
        echo 'true';
    } else {
        echo 'Письмо не было принято для передачи';
    }
}