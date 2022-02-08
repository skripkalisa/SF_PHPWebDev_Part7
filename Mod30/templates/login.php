<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_GET['name'])) {
    $imageFileName = $_GET['name'];
}
if (getLoginStatus()) {
    header("location: index.php?page=1");
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
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?page=1';?>"
    method="post">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email"
        class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
        value="<?php  echo $email ? $email : ''; ?>">
      <span class="invalid-feedback"><?php echo $email_err; ?></span>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password"
        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
      <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Don't have an account? <a href="?page=6">Sign up now</a>.</p>
  </form>
</div>