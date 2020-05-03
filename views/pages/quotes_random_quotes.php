<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<form action="https://mrbooks.ru/quotes/random-quotes" method="post">
    <input style="margin-left: auto; margin-right: auto;"
           class="form_button" type="submit" value="Показать пять случайных цитат">
</form>

<?php foreach ($quotes_list as $quote): ?>

    <div class="quotes"><?= $quote['quote'] ?><br>
        <p class="source"><?= $quote['bookname'] ?></p>
        <p class="source"><?= $quote['author'] ?></p>
    </div>

<?php endforeach; ?>


<form action="https://mrbooks.ru/quotes/random-quotes" method="post">
    <input style="margin-left: auto; margin-right: auto;"
           class="form_button" type="submit" value="Показать пять случайных цитат">
</form>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>