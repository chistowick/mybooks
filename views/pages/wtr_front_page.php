<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<form action="https://mrbooks.ru/what-to-read/recommendations/by-genre" method="post">

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

    <input type="hidden" name="what_to_read" value="request">
    </br><input class="form_button" type="submit" value="Готово">
</form>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>