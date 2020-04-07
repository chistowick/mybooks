<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Publications {

    public $id;
    public $title;
    public $short_description;
    public $text;
    public $main_image;
    public $liked;
    public $disliked;
    public $datestamp;
    public $author;
    public $href;

    public function __construct(array $row) {
        $this->id = $row['id'];
        $this->href = 'index.php?mainpage=one_page&publication_id=' . $this->id;
        $this->title = $row['title'];
        $this->short_description = $row['short_description'];
        $this->text = $row['text'];
        $this->main_image = $row['main_image'];
        $this->liked = $row['liked'];
        $this->disliked = $row['disliked'];
        $this->datestamp = $row['datestamp'];
        $this->author = $row['author'];
    }

}

class Articles extends Publications {

    public function printItem() {
        echo '<div clsss=publications"><br><hr><br>';
        echo "<a href='" . $this->href . "'>";
        echo "<h3 class='title'>" . $this->title . "</h3></a>";
        echo "<p>" . $this->short_description . "</p>";
        echo '<p style="text-align: right;">' . $this->datestamp . "</p>";
        echo '<hr style="clear: both"><br></div>';
    }

    public function printOnePage() {
        echo "<h2>" . $this->title . "</h2>";
        echo $this->text;
        echo '<p style="text-align: right;">' . $this->datestamp . "</p>";
    }

}

class Reviews extends Publications {

    public function printItem() {

        echo "<div clsss='publications'><br><hr><br>";
        echo "<a href='" . $this->href . "'>";
        echo "<img class='imgReviews' src='" . $this->main_image . "'></a>";
        echo "<a href='" . $this->href . "'>";
        echo "<h3 class='title'>" . $this->title . "</h3></a>";
        echo '<span class="author">(' . $this->author . ")</span>";
        echo '<div class="liked-disliked">';
        echo '<ul class="liked">' . $this->liked . '</ul>';
        echo '<ul class="disliked">' . $this->disliked . '</ul>';
        echo '</div>';
        echo '<br><p class="datestamp">' . $this->datestamp . "</p>";
        echo '<hr style="clear: both"><br></div>';
    }

    public function printOnePage() {
        echo '<img class="imgReviews" src="' . $this->main_image . '">';
        echo "<h2>" . $this->title . "</h2>";
        echo $this->text;
        echo '<p style="text-align: right;">' . $this->datestamp . "</p>";
        echo '<h3 class="back_href">';
        echo '<a href="index.php">Вернуться на главную страницу</a>';
        echo '</h3>';
    }

}
