<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>


<?php if ($recommendations_list) : ?>

    <h2>Рекомендую почитать следующие книги:</h2>

    <table id='booktable'>
        <tr id='firstrow'>
            <th style='min-width: 150px;'>Название</th>
            <th style='min-width: 150px;'>Серия</th>
        </tr>

<?php endif; ?>

<?php
    $lastAuthor = 'any';
    $i = 0;
?>

<?php foreach ($recommendations_list as $recommendation) : ?>

        <!--If the author is changing, output an empty string 
        and the name of the new author-->
    <?php if ($recommendation['author'] != $lastAuthor) : ?>

            <tr>
                <td class='notrow' colspan='2'></td>
            </tr>
            <tr>
                <th class='authorrow' colspan='2'><?= $recommendation['author'] ?></th>
            </tr>

    <?php endif; ?>

        <tr>
            <td><?= $recommendation['book_name'] ?></td>
            <td><?= $recommendation['series'] ?></td>
        </tr>

    <?php
    $lastAuthor = $recommendation['author'];
    $i++;
    ?>

<?php endforeach; ?>

</table>

<!--If the counter didn't count anything, prints the message-->
<?php if ($i == 0) : ?>

    <h3>К сожалению, по вашему запросу ничего не найдено.</h3>

<?php endif; ?>

<br>
<br>
<a href="https://mrbooks.ru/what-to-read"><h3>Выбрать другой жанр</h3></a>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>