<?php

/* 
 * обработчик данных из формы includes\feedback.php, пересылающий 
 * введенные данные на почту
 */

$to = "chistowick@yandex.ru";
$subject = $_POST['feedback_message_subject'];

$message = "Имя пользователя: " . $_POST['feedback_user_name'] . "\r\n";
$message .= "Email пользователя: " . $_POST['feedback_user_email'] . "\r\n\r\n";
$message .= "Текст письма:" . "\r\n\r\n" . $_POST['feedback_message'];

$headers = 'Content-type: text/plain;';

if (mail($to, $subject, $message, $headers)) {
    echo "<h3>Ваше сообщение успешно отправлено!</h3>";
} else {
    echo "<h3>Что-то пошло не так! Попробуйте ещё раз.</h3>";
}

echo "<br>";
echo '<a href="../index.php" ><h3>Вернуться на сайт</h3></a>';