<?php
require_once dirname(__DIR__, 1) .'/bootstrap.php';


$errors = [];
$messages = [];

if (isset($_GET['name'])) {
    $imageFileName = $_GET['name'];
}
$commentFilePath = COMMENT_DIR . '/' . $imageFileName . '.txt';

// Если коммент был отправлен
if (!empty($_POST['comment'])) {
    $comment = trim($_POST['comment']);

    // Валидация коммента
    if ($comment === '') {
        $errors[] = 'Вы не ввели текст комментария';
    }

    // Если нет ошибок записываем коммент
    if (empty($errors)) {
        $breaklines = "\r \n";
        $breaklinesArr = array(["\r\n","\r","\n","\\r","\\n","\\r\\n"]);
        // Чистим текст, земеняем переносы строк на <br/>, дописываем дату
        $comment = strip_tags($comment);
        $comment = str_replace($breaklines, "<br/>", $comment);
        $comment = date('d.m.y H:i') . ': ' . $comment;

        $comment =  $comment. ' <i>Автор: ' . $_SESSION['username'] . '</i>';
        // $comment =  $comment;

        // Дописываем текст в файл (будет создан, если еще не существует)
        file_put_contents($commentFilePath, $comment . "\n", FILE_APPEND);

        $messages[] = 'Комментарий был добавлен';
    }
}
if (!empty($_POST['line'])) {
    $file = $commentFilePath;
    $remove = $_POST['line'];

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $key => $line) {
        if ($line === $remove) {
            unset($lines[$key]);
        }
    }
    $data = implode(PHP_EOL, $lines);
    file_put_contents($file, $data);
}
// Получаем список комментов
$comments = file_exists($commentFilePath)
    ? file($commentFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    : [];
