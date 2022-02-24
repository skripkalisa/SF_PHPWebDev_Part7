<h1> Contacts </h1>

<form method="POST" name="authorization" action="?page=4">
  Логин: <input type="text" name="user_name"><br>
  Пароль: <input type="password" name="user_password"><br>
  <input type="submit" value="Войти">
</form>

<?php
var_dump($_POST);


//После выполнения этой команды в $_SESSION['var'] станет null:
unset($_SESSION['counter']);
