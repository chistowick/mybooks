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
    
    echo "<div id='content'>";

//Проверяем наличие данных в массиве $_POST, переданных из формы поиска книги
if (!isset($_POST['genre'])){
    $_POST['genre'] = '';
}
if (!isset($_POST['author'])){
    $_POST['author'] = '';
}

    if (isset($_POST['toread'])){    
        
    $sql = "SELECT * FROM mybooks.books WHERE idgenre = ? AND idauthor = ?";
        
        $pdostmt = $dbh->prepare($sql);
        
        $pdostmt->bindParam(1, $_POST['idgenre']);
        $pdostmt->bindParam(2, $_POST['idauthor']);
        
        $pdostmt->execute();     
        
        $i=0;
        
        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)){
           $i++;     
           echo 'Название: '.$row['bookname']."</br>"
                ."Автор: ".$row['author']."</br>"
                ."Жанр: ".$row['genre']."</br>"
                ."Серия: ".$row['series']."</br></br>";
        }
        
        if ($i==0){
            echo "<h3>К сожалению, по вашему запросу ничего не найдено.</h3>"; 
        }
        
        echo '<a href="index.php?pageName=toread">Попробовать ещё раз</a>';
        
    } else {
        {$sql = "SELECT * FROM mybooks.authors ORDER BY authorname";
        $pdostmt=$dbh->prepare($sql);
        
        $pdostmt->execute();}
        
        //Форма для задания параметров подбора книги
        echo '<form action="index.php?pageName=toread" method="post">';
        echo '<p><select name="idauthor" size="1">';
        echo '<option disabled>Выберите автора</option>';
        
            while ($row=$pdostmt->fetch(PDO::FETCH_ASSOC)){
                echo '<option value='.$row['id'].'>'.$row['authorname'].'</option>';
            }
        
        echo '</select>';
        
        {$sql = 'SELECT * FROM mybooks.genres ORDER BY genrename';
        $pdostmt=$dbh->prepare($sql);
        
        $pdostmt->execute();}
        
        echo '<select name="idgenre" size="1">';
        echo '<option disabled>Выберите жанр</option>';
        
            while ($row=$pdostmt->fetch(PDO::FETCH_ASSOC)){
                echo '<option value='.$row['id'].'>'.$row['genrename'].'</option>';
            }
        
        echo '</select>'; 
        
        echo '<input type="hidden" name="toread" value="1">';
        echo '<input type="submit" value="Готово">';
        echo '</p></form>';
    }
    echo "</div>";;
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