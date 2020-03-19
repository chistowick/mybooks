<?php

/* 
 * Форма с радиокнопками для выбора жанра книги. Сделана статичной,
 * потому что на этапе добавления книг в таблицу БД реализовать 
 * автоматическую генерацию данной формы не представляется разумным. После того, 
 * как жанры и поджанры будут четко определены и будет полностью сформирована
 * соответствующая таблица, будет смысл реализовать автогенерацию формы
 */

echo '<form action="index.php?pageName=toread" method="post">';

echo '<p><b>Фантастика</b></p>
<p><input name="idgenre" type="radio" value="4">Научная фантастика</p>
<p><input name="idgenre" type="radio" value="8">Научная фантастика, детектив</p>
<p><input name="idgenre" type="radio" value="11">Социальная научная фантастика</p>
<p><input name="idgenre" type="radio" value="9">Юмористическая научная фантастика</p>';

echo '<p><b>Фэнтези</b></p>
<p><input name="idgenre" type="radio" value="5">Городское фэнтези</p>
<p><input name="idgenre" type="radio" value="2">Подростковое фэнтези</p>
<p><input name="idgenre" type="radio" value="1">Эпическое фэнтези</p>
<p><input name="idgenre" type="radio" value="3">Юмористическое фэнтези</p>';

echo '<p><b>Реализм</b></p>
<p><input name="idgenre" type="radio" value="10">Историко-приключенческий роман</p>
<p><input name="idgenre" type="radio" value="7">Классический реализм</p>
<p><input name="idgenre" type="radio" value="6">Юмористическая повесть</p>';

echo '<input type="hidden" name="toread" value="1">
</br><input id="ready" type="submit" value="Готово">
</form>';