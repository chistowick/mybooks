<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<?php if ($one_publication['type'] == 'Articles') : ?>

    <h2><?= $one_publication['title'] ?></h2>

    <?= $one_publication['short_description'] ?>

    <?= $one_publication['text'] ?>

    <p style="text-align: right;"><?= $one_publication['datestamp'] ?></p>

    <h3 class="back_href">
        <a href="https://mrbooks.ru">Вернуться на главную страницу</a>
    </h3>

<?php endif; ?>

<?php if ($one_publication['type'] == 'Reviews') : ?>

    <img class="imgReviews" src="https://mrbooks.ru/<?= $one_publication['main_image'] ?>">

    <h2><?= $one_publication['title'] ?></h2>

    <?= $one_publication['text'] ?>

    <p style="text-align: right;"><?= $one_publication['datestamp'] ?></p>

    <h3 class="back_href">
        <a href="https://mrbooks.ru">Вернуться на главную страницу</a>
    </h3>

<?php endif; ?>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>