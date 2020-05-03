<?php

/**
 * Description of Quote
 */
class Quote {

    public static function getRandomQuotes() {

        define("QUANTITY", 5);

        // Connecting to database
        $dbh = Database::getConnection();

        // Getting the number of rows in a table with quotes (tquotes)
        $sql = "SELECT COUNT(*) FROM tquotes";
        $pdostmt = $dbh->prepare($sql);
        $pdostmt->execute();

        // Here $countRow[0] getting number of rows in a table with quotes
        $countRow = $pdostmt->fetch(PDO::FETCH_NUM);

        // change to integer
        $countRow[0] = intval($countRow[0]);

        // checking the possibility to filling the array - $random_array
        if ($countRow[0] < QUANTITY) {
            return false;
        }

        $i = 1;
        $random_array = array();

        // Filling the $random_array to size of $quantity 
        while (count($random_array) < QUANTITY) {

            $curent_number = rand(1, $countRow[0]);

            if (!in_array($curent_number, $random_array)) {

                $random_array[$i] = $curent_number;
                $i++;
            }
        }

        // Preparing and executing request
        $sql = "SELECT quote, bookname, author FROM tquotes WHERE id = ?";

        for ($j = QUANTITY; $j > 1; $j--) {

            $sql .= " OR id = ?";
        }

        $pdostmt = $dbh->prepare($sql);

        // Setting values for placeholders
        foreach ($random_array as $key => $value) {
            $pdostmt->bindParam($key, $random_array[$key]);
        }

        $pdostmt->execute();

        $quotes_list = array();

        // Filling an array with data from the pdo-statement
        $k = 1;

        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {

            $quotes_list[$k]['quote'] = $row['quote'];
            $quotes_list[$k]['bookname'] = $row['bookname'];
            $quotes_list[$k]['author'] = $row['author'];

            $k++;
        }

        return $quotes_list;
    }

}
