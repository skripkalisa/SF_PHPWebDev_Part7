<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';
require_once dirname(__DIR__, 1).'/engine/login.php';


// Check if the user is logged in, if not then redirect him to login page
if (!getLoginStatus()) {
    header("location: ?page=1");
    exit;
}
?>

<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
  Welcome to our site.
</h1>
<p>
  <?php if (isset($_COOKIE['vk'])):?>
  <img src="<?php echo $_SESSION['avatar']?>"
    class='mx-1 w-200 h-200 img-fluid img-thumbnail' />
  <?php endif?>

  <a href="?page=8" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</p>