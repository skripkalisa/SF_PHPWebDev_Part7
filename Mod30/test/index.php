<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../config/lib.php';
include_once '../config/connect.php';

$pages = include '../config/pages.php';

// var_dump($pages);
// echo "<br />";
// echo "<br />";
// $page = (int)$_GET['page'];
$page = getPage($pages);
// var_dump($page);
// echo "<br />";
// echo "<br />";


//Инициализируем сессию:
/* Переменная $_SESSION['counter'] будет нашим счетчиком. Если скрипт запускается первый раз - она будет пуста, присвоим ей единицу. Если не первый раз - тогда прибавим единицу.
 */
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter'] = $_SESSION['counter'] + 1;
}
//Запишем куку на час (в часе 3600 секунд!):
setcookie("test", "Тест!", time() + 3600);
//Выведем на экран значение куки test:
// echo $_COOKIE['test'];
//Выведем значение счетчика:
echo 'Вы обновили эту страницу ' . $_SESSION['counter'] . ' раз!';

/* Обновите страницу несколько раз, посмотрите на то, как увеличивается значение переменной. Затем закройте браузер, подождите полчаса и откройте снова - убедитесь в том, что переменная обнулилась!
 */
$value = 'someValue';
setcookie('some', $value);

header('Set-cookie: test123=testValue123');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <ul>
    <li>
      <a href="?page=1">Главная</a>
    </li>
    <li>
      <a href="?page=2">О себе</a>
    </li>
    <li>
      <a href="?page=3">Контакты</a>
    </li>
    <li>
      <a href="?page=5">Register</a>
    </li>
    <li>
      <a href="?page=6">Users</a>
    </li>
  </ul>
  <?php

// include '../pages/' . $pages[$page];
include '../pages/' . $page;

?>

</body>

</html>