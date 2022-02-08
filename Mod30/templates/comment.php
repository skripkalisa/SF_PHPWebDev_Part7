<?php

require_once dirname(__DIR__, 1). '/engine/comment.php';

if (isset($_GET['name'])) {
    $imageFileName = $_GET['name'];
}
?>

<div class="container pt-4">

  <h1 class="mb-4"><a href="<?php echo URL; ?>">Галерея
      изображений</a></h1>

  <!-- Вывод сообщений об успехе/ошибке -->
  <?php foreach ($errors as $error): ?>
  <div class="alert alert-danger"><?php echo $error; ?>
  </div>
  <?php endforeach; ?>

  <?php foreach ($messages as $message): ?>
  <div class="alert alert-success"><?php echo $message; ?>
  </div>
  <?php endforeach; ?>

  <h2 class="mb-4">Файл <?php echo $imageFileName; ?>
  </h2>

  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2">

      <img
        src="<?php echo URL .  UPLOAD_DIR . '/' . $imageFileName ?>"
        class="img-thumbnail mb-4"
        alt="<?php echo $imageFileName ?>">

      <h3>Комментарии</h3>
      <?php if (!empty($comments)): ?>
      <?php foreach ($comments as $key => $comment): ?>
      <div>

        <form method="post">
          <span
            class="<?php echo (($key % 2) > 0) ? 'bg-light' : ''; ?>">
            <?php echo $comment; ?>
            <?php if (getLoginStatus() && strpos($comment, $_SESSION['username'])|| isAdmin()):?>
            <span>
              <input type="hidden" name="line"
                value="<?php echo $comment; ?>">
              <button type="submit" class="btn-close float-end" aria-label="Close">
              </button>
            </span>
        </form>
        <?php endif;?>
        <!-- remove_line($imageFileName, $comment); -->
        </span>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <p class="text-muted">Пока ни одного коммантария, будте первым!</p>
      <?php endif; ?>

      <!-- Форма добавления комментария -->
      <?php if (getLoginStatus()):?>
      <form method="post">
        <div class="form-group">
          <label for="comment">Ваш комментарий</label>
          <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Отправить</button>
      </form>

      <?php else:?>
      <p class="text-muted">Комментарии могут оставлять только
        <a class="text-decoration-none" href="?page=6">зарегистрированные</a>
        <a class="text-decoration-none" href="?page=5">пользователи</a>
      </p>
      <a class="text-decoration-none" href="?page=6">

        <button class="btn btn-primary">Зарегистрироваться</button>
      </a>
      <a class="text-decoration-none" href="?page=5">

        <button class="btn btn-secondary">Войти</button>
      </a>
      <?php endif;?>
    </div>
  </div><!-- /.row -->

</div>