<?php

/*
 * Data handler from the feedback form 
 * that sends the entered data to the email address
 */

$to = "chistowick@yandex.ru";
$subject = $_POST['feedback_message_subject'] . ' *форма обратной связи на сайте mrbooks.ru*';

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
echo '<a href="https://mrbooks.ru" ><h3>Вернуться на сайт</h3></a>';
