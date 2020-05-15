<!--Content of the "about-me" page-->

<!--Connecting the top part of the main template-->
<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<img id='iam' src='https://mrbooks.ru/img/iam.jpg'>
<?= $about_me['text'] ?>

<!--Connecting the bottom part of the main template-->
<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>