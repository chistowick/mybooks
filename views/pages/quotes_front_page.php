<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<h2>Лучше, чем цитаты, могут быть только случайно отобранные цитаты.
    Жмякните на кнопку!</h2>

<form action="https://mrbooks.ru/quotes/random-quotes" method="post">
    <input style="margin-left: auto; margin-right: auto;"
           class="form_button" type="submit" value="Показать пять случайных цитат">
</form>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>