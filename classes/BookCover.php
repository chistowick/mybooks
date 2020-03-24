<?php

/**
 * Класс Books для объектов book, хранящих полную информации о книге
 */
class BookCover {
    public $id = NULL;
    public $book_name = NULL;
    public $author = NULL;
    public $series = NULL;
    
    public function __construct($row) {
        $this->id = $row['id'];
        $this->book_name = $row['book_name'];
        $this->author = $row['author'];
        $this->series = $row['series'];
    }
}

class Book extends BookCover{
    public $original_name = NULL;
    public $id_author = NULL;
    public $genre = NULL;
    public $id_genre = NULL;
    public $comment = NULL;
    
    public function __construct($row) {
        parent::__construct($row);
        $this->original_name = $row['original_name'];
        $this->id_author = $row['id_author'];
        $this->genre = $row['genre'];
        $this->id_genre = $row['id_genre'];
        $this->comment = $row['comment'];
    }
}
