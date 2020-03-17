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
    
<div id='content'> <!--Начало content-->
    
<?php 
	
switch($pageName){
    
case "mainpage":
    
    echo $mainRow['text'];
    break;
    
case "about":
    
    echo "<img id='iam' src='img/iam.jpg'>";
    echo $mainRow['text'];
    break;
	
case "characters":
    
    echo $mainRow['text'];
    break;
    
case "toread":
    
//Если из формы был передан запрос на формирование таблицы с рекомендациями
if (isset($_POST['toread'])){    
    
        //Подготавливаем запрос к БД
        $sql = "SELECT * FROM mybooks.books WHERE idgenre = ? ";
        $sql .= "ORDER BY author, series, id";
        
        $pdostmt = $dbh->prepare($sql);
        $pdostmt->bindParam(1, $_POST['idgenre']);
        $pdostmt->execute();     
        
        $i=0;
 
//Формируем таблицу с результатами запроса к БД        
        echo "<h2>Рекомендуем почитать следующие книги:</h2>
            <table id='booktable'>
                <tr id='firstrow'>
                    <th>Название</th>
                    <th>Серия</th>
                </tr>";
        
           $lastAuthor = 'any';
           
//Перебираем все извлеченные строки и формируем таблицу построчно       
while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)){
   $i++;
   
   //Если автор сменяется, выводим пустой табличный ряд и имя нового автора
    if ($row['author'] != $lastAuthor){
        echo "<tr><td class='notrow' colspan='2'></td></tr>
            <tr><th class='authorrow' colspan='2'>".$row['author']."</th></tr>";
    }
        echo '<tr>';
        echo '<td>'.$row['bookname'].'</td>';
        echo '<td>'.$row['series'].'</td>';
        echo '</tr>';

       $lastAuthor = $row['author'];
} //конец while
        echo '</table>';
    //Если счетчик цикла вывода ничего не насчитад,выводим сообщение    
    if ($i==0){
        echo "<h3>К сожалению, по вашему запросу ничего не найдено.</h3>"; 
    }
        //вернуться к выбору другого жанра
        echo '</br></br><a href="index.php?pageName=toread">
              <h3>Выбрать другой жанр</h3></a>';
        
 //конец успешного if (isset($_POST['toread'])
 //Завершение формирования таблицы вывода рекомендаций
        
} else {
    
//Если на страницу ещё не было запроса на выдачу рекомендаций, 
//то есть еще не было передано $_POST['toread'], тогда выводим форму
echo '<form action="index.php?pageName=toread" method="post">';

echo '<p><b>Фантастика</b></p>
<p><input name="idgenre" type="radio" value="4">Научная фантастика</p>
<p><input name="idgenre" type="radio" value="8">Научная фантастика, детектив</p>
<p><input name="idgenre" type="radio" value="11">Социальная научная фантастика</p>
<p><input name="idgenre" type="radio" value="9">Юмористическая научная фантастика</p>';

echo '<p><b>Фэнтези</b></p>
<p><input name="idgenre" type="radio" value="5">Городское фэнтези</p>
<p><input name="idgenre" type="radio" value="2">Подростковое фэнтези</p>
<p><input name="idgenre" type="radio" value="1">Эпическое фэнтези</p>
<p><input name="idgenre" type="radio" value="3">Юмористическое фэнтези</p>';

echo '<p><b>Реализм</b></p>
<p><input name="idgenre" type="radio" value="10">Историко-приключенческий роман</p>
<p><input name="idgenre" type="radio" value="7">Классический реализм</p>
<p><input name="idgenre" type="radio" value="6">Юмористическая повесть</p>';

echo '<input type="hidden" name="toread" value="1">
</br><input id="ready" type="submit" value="Готово">
</form>';
}
	break;
	
case "quotes":
    
    echo $mainRow['text'];
    break;
	
default: break;
}
?>
</div><!--Конец content -->
</div><!--конец wrapper -->
<div id="footer"><p id="copy">&copy; 2020 Анатолий Чиняев</p></div>

</body>
</html>