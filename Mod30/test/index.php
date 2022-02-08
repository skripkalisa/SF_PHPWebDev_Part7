<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../config/lib.php';
include_once '../config/connect.php';

$pages = include '../config/pages.php';
$page = getPage($pages);

// var_dump($pages);
// echo "<br />";
// echo "<br />";
// $page = (int)$_GET['page'];
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


<html>

<head>
  <title>Registration</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
    integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
  </script>
  <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
  </script>
  <script defer src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script defer src="/assets/js/form.js"></script>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-4">
        <form id="registration">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
              placeholder="Введите email">
            <div class="form-control-feedback"></div>
          </div>
          <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
              placeholder="Введите имя">
            <div class="form-control-feedback"></div>
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
            <div class="form-control-feedback"></div>
          </div>
          <div class="form-group">
            <label for="repeat-password">Повторение пароля</label>
            <input type="password" class="form-control" id="repeat-password" name="repeat-password"
              placeholder="Повторите пароль">
            <div class="form-control-feedback"></div>
          </div>
          <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
      </div>
    </div>


    <div class="row justify-content-center">
      <div class="col-10">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Зарегистрирован</th>
            </tr>
          </thead>
          <tbody>
            <?php

                                $users = getUsersList();
                            ?>
            <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
            <tr>
              <th scope="row"><?= $user['id'] ?>
              </th>
              <td><?= $user['name'] ?>
              </td>
              <td><?= $user['email'] ?>
              </td>
              <td><?= $user['created_at'] ?>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>