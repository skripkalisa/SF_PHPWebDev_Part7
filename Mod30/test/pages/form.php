<?php
if (!empty($_POST['username'] && $_POST['user_password'])) {
  echo "<h1>Success</h1>
  <p>Спасибо за Вашу обратную связь</p>";
} else {
  echo "<h1>Error</h1>
  <p>Упс, что-то пошло не так</p>";
}