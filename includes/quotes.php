<?php

/* 
 * 
 */
echo "<h2>Лучше, чем цитаты, могут быть только случайно отобранные цитаты.
        Жмякните на кнопку!</h2>";

echo '<form action="index.php?pageName=quotes" method="post">
        <input type="hidden" name="quotes" value="active">
        <input style="margin-left: auto; margin-right: auto;"
        class="form_button" type="submit" value="Показать пять случайных цитат">
        </form>';

if (isset($_POST['quotes'])){
//Узнаем количество строк в тпблице с цитататми (tquotes)
$sql = "SELECT COUNT(*) FROM tquotes";
$pdostmt = $dbh->prepare($sql);
$pdostmt->execute();

//здесь в $countRow[0] попадет значение количества строк из таблицы tquotes
$countRow = $pdostmt->fetch(PDO::FETCH_NUM);

//Приводим значение $countRow[] к типу INT и записываем его 
//в переменную $countRow. Задаем счетчик индексов элементов будущего массива
$countRow = 1 * $countRow[0];
$i=1;

$result_array = array(); //Задаем пустой массив для хранения случайных чисел

//Пока в массиве не наберется 5 элементов 
//Генерируем случайные числа от 1 до $countRow и записываем их в очередной 
//элемент массива в случае, если такого значения в массиве ещё нет
while(count($result_array) < 5){
    
    $curent_number = rand(1, $countRow); 

    if (!in_array($curent_number, $result_array)){
        
        $result_array[$i] = $curent_number;
        $i++;
    }
}
// Формируем подготовленный запрос к БД
$sql = "SELECT quote, bookname, author FROM tquotes WHERE ";
$sql .= "id = ? OR id = ? OR id = ? OR id = ? OR id = ?";

$pdostmt = $dbh->prepare($sql);

//Перебираем массив и присваиваем плейсхолдерам порядок ключей и
//соответствующие значения массива $result_array
foreach ($result_array as $key => $value) {
    $pdostmt->bindParam($key, $result_array[$key]);
}

$pdostmt->execute();

//Выводим выбранные цитаты
while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='quotes'>".$row['quote']."</br>";
    echo '<p class="source">'.$row['bookname']."</p>";
    echo '<p class="source">'.$row['author']."</p>";
    echo "</div>";
}

echo '<form action="index.php?pageName=quotes" method="post">
        <input type="hidden" name="quotes" value="active">
        <input style="margin-left: auto; margin-right: auto;"
        class="form_button" type="submit" value="Показать пять случайных цитат">
        </form>';
}
