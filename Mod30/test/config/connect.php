<?php
require_once 'credentials.php';
//Соединяемся с базой данных используя наши доступы:
// $link = mysqli_connect($host, $user, $password, $db_name, $port);
// var_dump($link);
// if ($link->connect_error) {
//     die("connection failed: " . $link->connect_error);
//     // echo "connection failed.";
// }

/*
 Соединение записывается в переменную $link,
 которая используется дальше для работы mysqi_query.
 */
//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
// mysqli_query($link, "SET NAMES 'utf8'");

//Формируем тестовый запрос:
// $query = "SELECT * FROM testtable  WHERE id > 0";

//Делаем запрос к БД, результат запроса пишем в $result:
// $result = mysqli_query($link, $query) or die(mysqli_error($link));

// while ($row = mysqli_fetch_assoc($result)) {
//     $res[] = $row;
// }
// var_dump($res);

//Проверяем что же нам отдала база данных, если null – то какие-то проблемы:
// var_dump($result);

$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$sql = "SELECT * FROM workers WHERE id > 0";
$result = $db->query($sql);
$stmt = $db->query($sql);

// Ассоциативный
$result = $stmt->FETCH(PDO::FETCH_ASSOC);
// Ассоциативный
echo $result["name"];
echo "<br />";
echo "<br />";

// Нумерованный
$result = $stmt->FETCH(PDO::FETCH_NUM);
// Нумерованный
echo $result[0];
echo "<br />";
echo "<br />";

// Оба типа массивов одновременно
$result = $stmt->FETCH(PDO::FETCH_BOTH);
echo $result["name"];
echo "<br />";
echo $result[0];
echo "<br />";
echo "<br />";

// Объект
$result = $stmt->FETCH(PDO::FETCH_OBJ);


// Объект
echo $result->name;
echo "<br />";
echo "<br />";

$stmt = $db->query($sql);
$result = $stmt->FETCH(PDO::FETCH_LAZY);
echo $result->name;
echo "<br />";

echo $result["name"];
echo "<br />";
echo $result[0];
echo "<br />";
echo "<br />";

$stmt = $db->query("SELECT * FROM workers");
$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
foreach ($result as $worker) {
    echo 'Name: ' . $worker["name"] . ' Age: ' . $worker["age"] . ' Salary: ' . $worker["salary"] . "<br>";
}


$stmt = $db->prepare("INSERT INTO users (id, name, login) VALUES (:id,:name, :login)");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':login', $login);


// Вставим одну строку с такими значениями
$id = 99991;
$name = 'vasya';
$login = 'vasya123';
$stmt->execute();


// Теперь другую строку с другими значениями
$id = 99992;
$name = 'petya';
$login = 'petya123';
$stmt->execute();

$stmt = $db->query("SELECT * FROM user_s");
$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
foreach ($result as $user) {
    echo 'Name: ' . $user["name"] . ' Login: ' . $user["login"] . ' id: ' . $user["id"] . "<br>";
}
