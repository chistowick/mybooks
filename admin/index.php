<?php

include '../../htconfig/dbconnect.php'; //Подключаем данные для входа
    
    try{//Создаем дескриптор базы данных    
    $dbh = new PDO($dsn, $userName, $password);
    //echo "Подключение прошло успешно";
    
    } catch(PDOException $e){ //Ловим исключения
    echo "Error!:".$e->getMessage();
    die();
    }

//Подключаем текст функций авторизации   
include_once '../includes/fn_authorization.php';

    //Проверяем установлены ли правильные кукис
    if (isset($_COOKIE['login']) AND $_COOKIE['login'] == 'Authorised'){
        $contentFile = '../includes/admincontent.php';
        $message = '';
    } else { 
        //Проверяем был ли передан логопас из формы
        if (isset($_POST['username']) AND isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            //Пытаемся авторизовать логопас пользователя
            if(userAuthorization($username, $password, $dbh)){
                header("Location: index.php");
            } else {
                $contentFile = '../includes/authorizationForm.php';
                $message = 'Неверная пара логин-пароль! Попробуйте еще раз';
            }
        } else {
            $contentFile = '../includes/authorizationForm.php';
            $message = 'Пожалуйста, авторизуйтесь';
        }
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
<?php
    //Подключаем файл контента с проверкой его существования
    if (file_exists($contentFile)) {
        include $contentFile;
    }
?>
        </div>    
    </body>
</html>
