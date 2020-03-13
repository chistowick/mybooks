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
?>

<!DOCTYPE html>
<html>
<head>

<!--Строка для того, чтобы телефоны не увеличивали шрифт-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="добрая, кофейня, кофе, сладости, благодатная">
<meta name="description" content="Добрая кофейня в Санкт-Петербурге на ул.Благодатной. Всегда есть время для кофе!">

<title>Мой читательский дневник</title>

<!--Подключение таблицы стилей-->
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper">
    
<div id="header">
<!--    <h1>Мой читательский дневник</h1>-->
</div>
<div id="mainMenu">
	<div class="button"><a href="index.php">СТАТЬИ</a></div>
	<div class="button"><a href="index.php?pageName=about">О БЛОГЕ</a></div>
	<div class="button"><a href="index.php?pageName=characters">ПЕРСОНАЖИ</a></div>
	<div class="button"><a href="index.php?pageName=toread">ЧТО ПОЧИТАТЬ</a></div>
	<div class="button"><a href="index.php?pageName=quotes">ЦИТАТЫ</a></div>
</div>
<?php 
if (!isset($_GET['pageName'])) 
{
    echo "<div id='content'><p>Здесь будут располагаться статьи стартовой страницы</p></div>";
} else {
	
switch($_GET['pageName']) {
    
	
case "about":
    
	echo "<div id='content'><p>Здесь будет располагаться текст страницы ".$_GET['pageName']."</p></div>";
	break;
	
case "characters":
    
	echo "<div id='content'><p>Здесь будет располагаться текст страницы ".$_GET['pageName']."</p></div>";
	break;
    
case "toread":
    
    echo "<div id='content'>"; //Начало content

//Проверяем наличие данных в массиве $_POST, переданных из формы поиска книги
if (!isset($_POST['genre'])){
    $_POST['genre'] = '';
}
if (!isset($_POST['author'])){
    $_POST['author'] = '';
}

    if (isset($_POST['toread'])){    
    
//Подготавливаем запрос к БД
    $sql = "SELECT * FROM mybooks.books WHERE idgenre = ? ORDER BY author, series, id";
        
        $pdostmt = $dbh->prepare($sql);
        $pdostmt->bindParam(1, $_POST['idgenre']);
        $pdostmt->execute();     
        
        $i=0;
 
//Формируем таблицу с результатами запроса к БД        
        echo '<h2>Рекомендуем почитать следующие книги:</h2>';
        echo "<table id='booktable'>";
        
        echo "<tr id='firstrow'>";
            echo '<th>Название</th>';
            echo '<th>Серия</th>';
        echo '</tr>';
        
           $lastAuthor = 'any';
        
        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)){
           $i++;
        
           if ($row['author'] != $lastAuthor){
               echo "<tr><td class='notrow' colspan='2'></td></tr>";
               echo "<tr><th class='authorrow' colspan='2'>".$row['author']."</th></tr>";
           }
           
           echo '<tr>';
           echo '<td>'.$row['bookname'].'</td>';
           echo '<td>'.$row['series'].'</td>';
           echo '</tr>';
           
           $lastAuthor = $row['author'];
        }
        
        echo '</table>';
        
        if ($i==0){
            echo "<h3>К сожалению, по вашему запросу ничего не найдено.</h3>"; 
        }
        
        echo '</br></br><a href="index.php?pageName=toread"><h3>Выбрать другой жанр</h3></a>';
        
    } else {
        
//Форма для задания параметров подбора книги
        echo '<form action="index.php?pageName=toread" method="post">';
        
        echo '<p><b>Фантастика</b></p>';
        echo '<p><input name="idgenre" type="radio" value="4">Научная фантастика</p>';
        echo '<p><input name="idgenre" type="radio" value="8">Научная фантастика, детектив</p>';
        echo '<p><input name="idgenre" type="radio" value="9">Юмористическая научная фантастика</p>';
        
        echo '<p><b>Фэнтези</b></p>';
        echo '<p><input name="idgenre" type="radio" value="5">Городское фэнтези</p>';
        echo '<p><input name="idgenre" type="radio" value="2">Подростковое фэнтези</p>';
        echo '<p><input name="idgenre" type="radio" value="1">Эпическое фэнтези</p>';
        echo '<p><input name="idgenre" type="radio" value="3">Юмористическое фэнтези</p>';
        
        echo '<p><b>Реализм</b></p>';
        echo '<p><input name="idgenre" type="radio" value="10">Историко-приключенческий роман</p>';
        echo '<p><input name="idgenre" type="radio" value="7">Классический реализм</p>';
        echo '<p><input name="idgenre" type="radio" value="6">Юмористическая повесть</p>';
        
        echo '<input type="hidden" name="toread" value="1">';
        echo "</br><input id='ready' type='submit' value='Готово'>";
        echo '</form>';
    }
    echo "</div>"; //Конец content
	break;
	
case "quotes":
    
	echo "<div id='content'><p>Здесь будет располагаться текст страницы ".$_GET['pageName']."</p></div>";
	break;
	
default:
	break;
} 
}
?>

</div>
<div id="footer"><p id="copy">&copy; 2020 Анатолий Чиняев</p></div>


</body>
</html>