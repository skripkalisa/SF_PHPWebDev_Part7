<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';
?>

<?php if (getLoginStatus()):?>
<!-- Форма загрузки файлов -->
<form method="post" enctype="multipart/form-data">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="files[]" id="customFile" multiple required>
    <label class="custom-file-label" for="customFile" data-browse="Выбрать">Выберите файлы</label>
    <small class="form-text text-muted">
      Максимальный размер файла: <?php echo UPLOAD_MAX_SIZE / 1000000; ?>Мб.
      Допустимые форматы: <?php echo implode(', ', ALLOWED_TYPES) ?>.
    </small>
  </div>
  <hr>
  <button type="submit" class="btn btn-primary">Загрузить</button>
</form>

<?php else: ?>

<p class="text-muted">Загружать файлы могут только
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
