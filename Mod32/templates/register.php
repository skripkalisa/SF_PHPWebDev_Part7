<?php
require_once dirname(__DIR__, 1). '/engine/oauth.php';
?>


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
  <a <?php echo 'href="http://oauth.vk.com/authorize?' . http_build_query($params).'"' ?>>
    <input type="button" class="btn btn-info" value="Войти через VK">
  </a>

</form>
<p>Already have an account? <a href="?page=5">Login here</a>.</p>