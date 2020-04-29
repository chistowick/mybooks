<?php include_once (ROOT . '/views/main_parts/top_side_index.php'); ?>

<?php foreach ($publications_list as $publication) : ?> 

    <?php if ($publication['type'] == 'Articles') : ?>

        <div class=publications">
            <br><hr><br>

            <a href="/publications/articles/<?= $publication['id'] ?>">
                <h3 class="title"><?= $publication['title'] ?></h3>
            </a>

            <p style="margin-top: 16px;"><?= $publication['short_description'] ?></p>

            <p style="text-align: right;"><?= $publication['datestamp'] ?></p>

            <hr style="clear: both"><br></div>

    <?php endif; ?>

    <?php if ($publication['type'] == 'Reviews') : ?>

        <div class='publications'>
            <br><hr><br>

            <a href="/publications/reviews/<?= $publication['id'] ?>">
                <img class="imgReviews" src="https://mrbooks.ru/<?= $publication['main_image'] ?>">
            </a>

            <a href="/publications/reviews/<?= $publication['id'] ?>">
                <h3 class="title"><?= $publication['title'] ?></h3>
            </a>

            <span class="author">(<?= $publication['author'] ?>)</span>

            <div class="liked-disliked">
                <ul class="liked"><?= $publication['liked'] ?></ul>
                <ul class="disliked"><?= $publication['disliked'] ?></ul>
            </div>

            <br>
            <p class="datestamp"><?= $publication['datestamp'] ?></p>

            <hr style="clear: both"><br>
        </div>

    <?php endif; ?>

<?php endforeach; ?>

<?php include_once (ROOT . '/views/main_parts/bottom_side_index.php'); ?>