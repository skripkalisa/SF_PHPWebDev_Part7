<?php

define('URL', '/'); // URL текущей страницы
define('UPLOAD_MAX_SIZE', 1000000); // 1mb
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('UPLOAD_DIR', 'uploads');

$errors = [];

if (!empty($_FILES)) {
    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $fileName = $_FILES['files']['name'][$i];

        if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
            $errors[] = 'Недопустимый размер файла ' . $fileName;
            continue;
        }

        if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
            $errors[] = 'Недопустимый формат файла ' . $fileName;
            continue;
        }

        $filePath = UPLOAD_DIR . '/' . basename($fileName);
        echo $filePath;

        if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
            $errors[] = 'Ошибка загрузки файла ' . $fileName;
            continue;
        }
    }
}

echo  date("F j, Y, g:i a") . '<br>';                 // September 24, 2020, 11:35 pm
echo  date("m.d.y") . '<br>';                         // 09.24.20
echo  date("j, n, Y") . '<br>';                       // 24, 9, 2020
echo  date("Ymd") . '<br>';                           // 20200924
echo  date('h-i-s, j-m-y, it is w Day') . '<br>';     // 11-35-09, 24-09-20, 3530 3509 4 Thupm20
echo  date('\i\t \i\s \t\h\e jS \d\a\y.') . '<br>';   // it is the 24th day.
echo  date("D M j G:i:s T Y") . '<br>';               // Thu Sep 24 23:35:09 MSK 2020
echo  date('H:m:s \m \i\s\ \m\o\n\t\h') . '<br>';     // 23:09:09 m is month
echo  date("H:i:s") . '<br>';                         // 23:35:09
echo  date("Y-m-d H:i:s") . '<br><br><br>';


$date = date_create('2020-01-01');
date_modify($date, '-1 day');
echo date_format($date, 'd.m.Y'); // выведет 31.12.2019

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Загрузка файлов</title>
</head>

<body>

  <div class="container pt-4">
    <h1 class="mb-4">Загрузка файлов</h1>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($_FILES) && empty($errors)): ?>
    <div class="alert alert-success">Файлы успешно загружены</div>
    <?php endif; ?>

    <form action="<?php echo URL; ?>" method="post"
      enctype="multipart/form-data">
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
      <a href="<?php echo URL; ?>"
        class="btn btn-secondary ml-3">Сброс</a>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>
  <script>
    $(() => {
      bsCustomFileInput.init();
    })
  </script>
</body>

</html>