<?php
echo "INDEX";
echo "<br />";
?>

<ul>
  <li>
    <a href="?page=1">Главная</a>
  </li>
  <li>
    <a href="?page=2">Пользователи</a>
  </li>
  <li>
    <a href="?page=3">Пользователь</a>
  </li>
</ul>
<a href="?">TEST0</a><br>


<a href="?key=1&key1=про">TEST1</a><br>
<a href="?key=2&key2=test">TEST2</a><br>
<form method="post">

  <p>Ваш логин: <input type="text" name="login" /></p>

  <p>Ваш пароль: <input type="text" name="password" /></p>

  <p><input type="submit" /></p>

</form>



<form method="GET">

  <p>Ваш логин:
    <input type="text" name="userForm[login]" />

  </p>
  <p>Ваш пароль:
    <input type="text" name="userForm[password]" />

  </p>
  <input type="checkbox" name="test[]" value="1">
  <input type="checkbox" name="test[]" value="2">
  <input type="checkbox" name="test[]" value="3">
  <input type="submit" value="отправить">
</form>



<?php
echo "<br />";
var_dump($_GET);
echo "<br />";
echo "<br />";
var_dump($_POST);
echo "<br />";
