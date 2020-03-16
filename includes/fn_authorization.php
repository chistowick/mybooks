<?php

/* 
 * функции для установления авторизации пользователя по $username и $password, 
 * а также внесения данных об IP-адресе пользователя и времени доступа к системе
 * в таблицу логов
 */

function userAuthorization($username, $password, $dbh){
    
    $sql = "SELECT id, password, accesslevel FROM mybooks.tuser ";
    $sql .= "WHERE username = ?";
    
    $pdostmt = $dbh->prepare($sql);
    $pdostmt->bindParam(1, $username);
    $pdostmt->execute();
    
    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)){
        $userID = $row['id'];
        $passwordDB = $row['password'];
        $accessLevel = $row['accesslevel'];
    }
    
    if (!empty($passwordDB) AND password_verify($password, $passwordDB)){
        
        setcookie("accessLevel", $accessLevel, time()+3600, "/");
        setcookie("userID", $userID, time()+3600, "/");
        setcookie("login", 'Authorised', time()+3600, "/");
        
        $returnValue = true;
        
        $sessionLoggedSuccess = sessionLogging($userID, $dbh);
        if (!$sessionLoggedSuccess){
            setcookie("sessionLogging", 'failed', time()+600, '/');
        }
    } else {
        $returnValue = false;
    }
    
  return $returnValue;
}

function sessionLogging($userID, $dbh){
    
    $nowTime = date('Y-m-d H:i:s');
    $userIPaddress = $_SERVER['REMOTE_ADDR'];
    
    $sql = "INSERT INTO mybooks.tsessionlog (userid, timelogin, ipaddress) ";
    $sql .= "VALUES (? , ?, ?)";
    
    $pdostmt=$dbh->prepare($sql);
    $pdostmt->bindParam(1, $userID);
    $pdostmt->bindParam(2, $nowTime);
    $pdostmt->bindParam(3, $userIPaddress);
    $pdostmt->execute();
    
    $result = true;
    
 return $result; 
}