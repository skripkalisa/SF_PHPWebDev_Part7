<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';
// require_once dirname(__DIR__, 1) . '/engine/upload.php';
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

  <h2>Список файлов</h2>

  <!-- Вывод изображений -->
  <div class="mb-4">
    <?php if (!empty($files)): ?>
    <div class="row">
      <?php foreach ($files as $file): ?>

      <div class="col-12 col-sm-3 col-mb-4">

        <?php if (isAdmin()):?>
        <form method="post">
          <input type="hidden" name="name"
            value="<?php echo $file; ?>">
          <button type="submit" class="btn-close" aria-label="Close">
          </button>
        </form>
        <?php endif;?>

        <a href="<?php echo URL . '?page=4&name='  . $file;?>"
          title="Просмотр полного изображения">
          <img style="object-fit:cover; height:100%;"
            src="<?php echo URL .  UPLOAD_DIR . '/' . $file ?>"
            class="img-thumbnail img-responsive"
            alt="<?php echo $file; ?>">
        </a>
      </div>

      <?php endforeach; ?>
    </div><!-- /.row -->
    <?php else: ?>
    <div class="alert alert-secondary">Нет загруженных изображений</div>
    <?php endif; ?>
  </div>
</div>