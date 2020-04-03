<?php

/* 
 * Форма обратной связи, отправляющая письмо на мой почтовый адрес
 */

echo '<form action="includes\feedback_email_action.php" method="POST">
    
    <span class="feedback"><label>Ваше имя: 
    <input type="text" name="feedback_user_name" placeholder="Укажите ваше имя" required />
    </label></span>
    
    <span class="feedback"><label>Ваш eMail: 
    <input type="email" name="feedback_user_email" placeholder="Введите ваш eMail" required />
    </label></span>
    
    <span class="feedback"><label>Тема письма: 
    <input type="text" name="feedback_message_subject" placeholder="Укажите тему письма" required />
    </label></span>
    
    <label><span class="feedback">Ваше сообщение: </span>
    <textarea name="feedback_message" rows="10" cols="50" maxlength="2000" placeholder="Введите текст вашего сообщения" required></textarea>
    </label>
    
    <span class="feedback"><input type="submit" value="Отправить" /></span>
</form>';