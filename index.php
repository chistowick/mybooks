<?php 
    
include '../htconfig/dbconnect.php'; //Подключаем данные для входа
    
try{
    //Создаем дескриптор базы данных    
    $dbh = new PDO($dsn, $userName, $password);
    //echo "Подключение прошло успешно"."<br/><br/>";
    
}   catch(PDOException $e){ //Ловим исключения
    echo "Error!:".$e->getMessage();
    die();
}

$pageName = 'mainpage'; //по умолчанию считаем, что запрпошена главная страница

//проверяем запрошена ли главная страница или другая
//и если не главная, то задаем переменной $pageName значение из массива $_GET
if (isset($_GET['pageName'])){
    $pageName = $_GET['pageName'];
}

$sql = "SELECT keywords, description, text FROM mybooks.tmain WHERE pagename = ?";
    
    $pdostmt = $dbh->prepare($sql);
    $pdostmt->bindParam(1, $pageName);
    $pdostmt->execute();
    
    //извлекаем информацию для соответствующей таблицы
    $mainRow = $pdostmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
<!--Строка для того, чтобы телефоны не увеличивали шрифт-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$mainRow['keywords']?>">
<meta name="description" content="<?=$mainRow['description']?>">

<title>Мой читательский дневник</title>

<!--Подключение таблицы стилей-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/favicon.png" type="image/png">

</head>
<body>
<div id="wrapper">
    
<div id="header">
<!--    <h1>Мой читательский дневник</h1>-->
</div>
    <div id="mainMenu">
<div class="button"><a href="index.php">СТАТЬИ</a></div>
<div class="button"><a href="index.php?pageName=about">О БЛОГЕ</a></div>
<div class="button"><a href="index.php?pageName=toread">ЧТО ПОЧИТАТЬ</a></div>
<div class="button"><a href="index.php?pageName=quotes">ЦИТАТЫ</a></div>
<div class="button"><a href="index.php?pageName=contacts">КОНТАКТЫ</a></div>
    </div>
    
<div id='content'> <!--Начало content-->
    
<?php 
	
switch ($pageName) {

    case "mainpage":
        //Подключаем классы публикаций
        require_once 'classes/publications.php';
        
        //Если запрошена конкретная статья, то нужно вывести её отдельно
        if (isset($_GET['mainpage']) AND $_GET['mainpage'] == 'one_page') {

            //Формируем, подготавливаем и выполняем запрос к таблице 
            //со статьями и отзывами
            $sql = "SELECT * FROM tpublications WHERE id = ?";

            $pdostmt = $dbh->prepare($sql);
            $pdostmt->bindParam(1, $_GET['publication_id']);
            $pdostmt->execute();

            $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
            
            //Создаем объект конкретного класса публикации
            $one_page = new $row['type']($row);
            
            //и вызываем его метод печати отдельной страницы
            $one_page->printOnePage();
            
        } else {

            //Формируем, подготавливаем и выполняем запрос к таблице 
            //со статьями и отзывами
            $sql = "SELECT * FROM tpublications ORDER BY id DESC";

            $pdostmt = $dbh->prepare($sql);
            $pdostmt->execute();

            $publications_row = array();

            //Формируем массив с объектами классов соответствующих типу отдельной 
            //публикации и наполняем объекты данными 
            while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                $publications_row[] = new $row['type']($row);
            }

            //Перебираем объекты и вызываем метод печати статьи/отзыва для каждого
            foreach ($publications_row as $one_publication) {
                $one_publication->printItem();
            }
        }

        break;

    case "about":

        echo "<img id='iam' src='img/iam.jpg'>";
        echo $mainRow['text'];
        break;

    case "toread":

        //Если из формы был передан запрос на формирование 
        //таблицы с рекомендациями
        if (isset($_POST['toread'])) {

            //Подготавливаем запрос к БД
            $sql = "SELECT * FROM mybooks.books WHERE id_genre = ? ";
            $sql .= "ORDER BY author, series, id";

            $pdostmt = $dbh->prepare($sql);
            $pdostmt->bindParam(1, $_POST['id_genre']);
            $pdostmt->execute();

            $i = 0;

            //Формируем таблицу с результатами запроса к БД        
            echo "<h2>Рекомендуем почитать следующие книги:</h2>
            <table id='booktable'>
                <tr id='firstrow'>
                    <th style='min-width: 150px;'>Название</th>
                    <th style='min-width: 150px;'>Серия</th>
                </tr>";

            $lastAuthor = 'any';

            //Перебираем все извлеченные строки и формируем таблицу построчно       
            while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                $i++;

                //Если автор сменяется, выводим пустой табличный ряд 
                //и имя нового автора
                if ($row['author'] != $lastAuthor) {
                    echo "<tr><td class='notrow' colspan='2'></td></tr>";
                    echo "<tr><th class='authorrow' colspan='2'>";
                    echo $row['author'];
                    echo "</th></tr>";
                }
                
                echo '<tr>';
                echo '<td>'.$row['book_name'].'</td>';
                echo '<td>'.$row['series'].'</td>';
                echo '</tr>';

                $lastAuthor = $row['author'];
            } //конец while
            
            echo '</table>';
            
            //Если счетчик цикла вывода ничего не насчитал,выводим сообщение    
            if ($i == 0) {
                echo "<h3>К сожалению, по вашему запросу ничего не найдено.</h3>";
            }
            //вернуться к выбору другого жанра
            echo '</br></br><a href="index.php?pageName=toread">
              <h3>Выбрать другой жанр</h3></a>';

            //конец успешного if (isset($_POST['toread'])
            //Завершение формирования таблицы вывода рекомендаций
        } else {

            //Если на страницу ещё не было запроса на выдачу рекомендаций, 
            //то есть не было передано $_POST['toread'], тогда подключаем 
            //файл с формой выбора жанра книги
            include 'includes/formgenre.php';
        }
        break;

    case "quotes":

        include 'includes/quotes.php';
        break;
    
    case "contacts":

        require 'includes\feedback.php';
        break;

    default: break;
}
?>
</div><!--Конец content -->
</div><!--конец wrapper -->
<div id="footer"><p id="copy">&copy; 2020 Анатолий Чиняев</p></div>

</body>
</html>