<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Publications
{
    public $title;
    public $short_description;
    public $text;
    public $main_image;
    public $liked;
    public $disliked;
    public $datestamp;
    public $author;


    public function __construct(array $row) {
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

class Articles extends Publications
{
    public function printItem() {
        echo '<div clsss=publications"><br><hr><br>';
        echo "<h3 class='title'>".$this->title."</h3>";
        echo "<p>".$this->short_description."</p>";
        echo '<p style="text-align: right;">'.$this->datestamp."</p>";
        echo '<hr style="clear: both"><br></div>';
    }
}

class Reviews extends Publications 
{
    public function printItem() {
        echo '<div clsss=publications"><br><hr><br>';
        echo '<img class="imgReviews" src="'.$this->main_image.'">';
        echo "<h3 class='title'>".$this->title."</h3>";
        echo '<span style="text-align: right;">('.$this->author.")</span>";
        echo '<div class="liked-disliked"><ul>'.$this->liked.'</ul></div>';
        echo '<div class="liked-disliked"><ul>'.$this->disliked.'</ul></div>';
        echo '<br><p style="text-align: right;">'.$this->datestamp."</p>";
        echo '<hr style="clear: both"><br></div>';
    }
}