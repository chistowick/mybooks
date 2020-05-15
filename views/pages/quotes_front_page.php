<!--Content of the "quotes" front page-->

<!--Connecting the top part of the main template-->
<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<!--content start-->
<h2 id="hello">Лучше, чем цитаты, могут быть только случайно отобранные цитаты.
    Жмякните на кнопку!</h2>


<button type="button" style="margin-left: auto; margin-right: auto;" 
        class="form_button get_random_quotes">Показать пять случайных цитат</button>

<!--scripts js-->
<?php
// Array of scripts to load in the main template
$scripts = array(
    "1" => "<script src='https://mrbooks.ru/js/get_random_quotes.js'></script>",
);
?><!--end scripts js-->

<!--content end-->

<!--Connecting the bottom part of the main template-->
<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>