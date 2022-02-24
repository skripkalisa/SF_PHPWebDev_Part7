<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';
require_once dirname(__DIR__, 1).'/engine/login.php';
include_once dirname(__DIR__, 1).'/engine/token.php';


// Check if the user is already logged in, if yes then redirect him to welcome page

login();
if (getLoginStatus()) {
    header("location: index.php?page=7");
    exit;
}

?>

<div class="wrapper">
  <h2>Login</h2>
  <p>Please fill in your credentials to login.</p>

  <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>


  <form
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?page=5';?>"
    method="post">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email"
        class="form-control <?php echo (isset($_SESSION["email_err"])) ? 'is-invalid' : ''; ?>"
        value="<?php  echo $email ? $email : ''; ?>">
      <span class="invalid-feedback"><?php echo (isset($_SESSION["email_err"])) ?  $_SESSION["email_err"]: ''; ?></span>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password"
        class="form-control <?php echo (isset($_SESSION["password_err"])) ? 'is-invalid' : ''; ?>">
      <span class="invalid-feedback"><?php echo (isset($_SESSION["password_err"])) ?  $_SESSION["password_err"] : ''; ?></span>
    </div>
    <input type="hidden" name="token" value="<?=$token?>">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="remember" id="flexCheckDefault" name="remember">
      <label class="form-check-label" for="flexCheckDefault">
        Запомнить меня
      </label>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Login">
      <a <?php echo 'href="http://oauth.vk.com/authorize?' . http_build_query($params).'"'; ?>>
        <input type="button" class="btn btn-info" value="Войти через VK">
      </a>
    </div>
    <p>Don't have an account? <a href="?page=6">Sign up now</a>.</p>
  </form>

</div>
<?php

$_SESSION["CSRF"] = $token;
