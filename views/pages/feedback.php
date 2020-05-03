<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<h3 style="text-align: center;">Если у Вас есть вопрос или предложение, 
    пожалуйста, свяжитесь со мной через эту форму</h3>

<div id="feedback_block">
    <form action="https://mrbooks.ru/components/feedback_email_action.php" method="POST">

        <div class="feedback"><label for="name">Ваше имя: </label>
            <input type="text" id="name" name="feedback_user_name" 
                   placeholder="Укажите ваше имя" maxlength="50" required />
        </div>

        <div class="feedback"><label for="email">Ваш eMail: </label>
            <input type="email" id="email" name="feedback_user_email" 
                   placeholder="Введите ваш eMail" maxlength="50" required />
        </div>

        <div class="feedback"><label for="subj">Тема письма: </label>
            <input type="text" id="subj" name="feedback_message_subject" 
                   placeholder="Укажите тему письма" maxlength="100" required />
        </div>

        <div class="feedback" id="textAreaBlock"><label for="textArea">Ваше сообщение: </label></div>
        <textarea id="textArea" name="feedback_message" rows="10" maxlength="2000" 
                  placeholder="Введите текст вашего сообщения" required></textarea>

        <div class="feedback"><input class="form_button" type="submit" value="Отправить" /></div>
    </form>
</div>
<div id="quill_block"><img id="quill" src="https://mrbooks.ru/img/quill.png"></div>
<div style="clear: both"></div>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>