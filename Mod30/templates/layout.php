<?php
include_once dirname(__DIR__, 1) .'/engine/lib.php';
$pages = include_once dirname(__DIR__, 1) .'/engine/pages.php';
$page = getPage($pages);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <!-- Google Fonts -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic'>

  <!-- CSS Reset -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.0/cerulean/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Document</title>

  <!-- You should properly set the path from the main file. -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script defer src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Gallery with comments</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
          aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
          <ul class="navbar-nav me-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Главная
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=1">Gallery</a>
            </li>
          </ul>
          <!-- <div>
            </div> -->
          <ul class="navbar-nav ">
            <?php if (!getLoginStatus()):?>
            <li class="nav-item">
              <a class="nav-link" href="?page=5">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=6">Register</a>
            </li>
            <?php else:?>
            <div class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>
            </div>
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="?page=2">Upload</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?page=7">User Area</a>
                <a class="dropdown-item" href="?page=8">Logout</a>
                <?php if (isAdmin()):?>
                <a class="dropdown-item" href="?page=3">Users</a>
                <?php endif;?>
              </div>
            </div>
            <?php endif;?>
          </ul>
        </div>

      </div>
    </nav>

  </header>

  <main>
    <div class="container">
      <section class="py-5 px-4">
        <?php include $page; ?>
      </section>
    </div>
  </main>

  <footer></footer>

</body>

</html>