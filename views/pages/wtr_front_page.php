<!--Content of the "what to read" page-->

<!--Connecting the top part of the main template-->
<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<!--content start-->
<div id="wtr_select_genre">
    <h2 id="hello">Выберите интересующий жанр, <br>а я постараюсь посоветовать хорошую книгу.</h2>

    <p><b>Фантастика</b></p>
    <ul>
        <li><label><input name="id_genre" type="radio" value="4" checked>Научная фантастика</label></li>
        <li><label><input name="id_genre" type="radio" value="8">Научная фантастика, детектив</label></li>
        <li><label><input name="id_genre" type="radio" value="11">Социальная научная фантастика</label></li>
        <li><label><input name="id_genre" type="radio" value="9">Юмористическая научная фантастика</label></li>
    </ul>

    <p><b>Фэнтези</b></p>
    <ul>
        <li><label><input name="id_genre" type="radio" value="5">Городское фэнтези</label></li>
        <li><label><input name="id_genre" type="radio" value="2">Подростковое фэнтези</label></li>
        <li><label><input name="id_genre" type="radio" value="1">Эпическое фэнтези</label></li>
        <li><label><input name="id_genre" type="radio" value="3">Юмористическое фэнтези</label></li>
    </ul>

    <p><b>Реализм</b></p>
    <ul>
        <li><label><input name="id_genre" type="radio" value="10">Историко-приключенческий роман</label></li>
        <li><label><input name="id_genre" type="radio" value="7">Классический реализм</label></li>
        <li><label><input name="id_genre" type="radio" value="6">Юмористическая повесть</label></li>
    </ul>

    </br><input class="form_button get_wtr_list" type="button" value="Готово">
</div>
<div id="recommendations_list"></div>

<!--scripts js-->
<?php
// Array of scripts to load in the main template
$scripts = array(
    "1" => "<script src='https://mrbooks.ru/js/get_wtr_list.js'></script>",
);
?><!--end scripts js-->

<!--content end-->

<!--Connecting the bottom part of the main template-->
<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>