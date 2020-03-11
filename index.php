<?php 
    include '../htconfig/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1"> <!--Строка для того, чтобы телефоны не увеличивали шрифт, а отображали его как есть-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="добрая, кофейня, кофе, сладости, благодатная">
<meta name="description" content="Добрая кофейня в Санкт-Петербурге на ул.Благодатной. Всегда есть время для кофе!">

<title>Мой читательский дневник</title>

<link href="css/style.css" rel="stylesheet" type="text/css" /><!--Подключение таблицы стилей-->

</head>
<body>
<div id="wrapper">
    
<div id="header"><h1>Мой читательский дневник</h1></div>
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
    
	echo "<div id='content'><p>Здесь будет располагаться текст страницы ".$_GET['pageName']."</p></div>";
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