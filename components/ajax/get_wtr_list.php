<?php

// Getting a 'what-to-read' list from the database
// DB connection Class
require_once ('../Database.php');

// Connect to the database with the parameters in the file at...
$dbh = Database::getConnection('../../../htconfig/dbconnect.php');

// Preparing and executing a request
$sql = "SELECT * FROM books WHERE id_genre = ? "
        . "ORDER BY author, series, id";

$pdostmt = $dbh->prepare($sql);
$pdostmt->bindParam(1, $_GET['id_genre']);
$pdostmt->execute();

$recommendations_list = array();

// Filling an array with data from the pdo-statement
$i = 0;

while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {

    $recommendations_list[$i]['author'] = $row['author'];
    $recommendations_list[$i]['book_name'] = $row['book_name'];
    $recommendations_list[$i]['series'] = $row['series'];

    $i++;
}

// Converts an array to a JSON representation
echo json_encode($recommendations_list);

//, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK