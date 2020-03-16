<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<h2>'.$message.'</h2>'."</br>"."</br>"."\n";
echo '<form method="post">
    <p><strong>Имя пользователя</strong></p>
    <input type="text" maxlength="16" name="username">
    <p><strong>Пароль</strong></p>
    <input type="password" maxlength="16" name="password">
    <p><input type="submit" value="Отправить"></p>   
</form>';