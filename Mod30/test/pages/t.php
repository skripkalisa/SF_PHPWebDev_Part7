<?php
ob_start();


$a = ob_get_clean();

echo '<hr>123' . $a;

$test = [1, 3, 5, 7];

// $file = fopen('log.txt', 'a');
// fwrite($file, "example". PHP_EOL);
// fwrite($file, implode(PHP_EOL, $test));
// fclose($file);

file_put_contents('log.txt', 'different data'. PHP_EOL, FILE_APPEND);
echo file_get_contents(dirname(__DIR__, 1). '/config/credentials.php');

echo file_get_contents('log.txt');
var_dump(scandir(__DIR__));

echo '<br /><br />';
var_dump(scandir(dirname(__DIR__, 1)));
?>
<form method='post' action="/index.php" enctype="multipart/form-data"> <input type="hidden" name="MAX_FILE_SIZE"
value="5000000">
<input type='file' name='file[]' class='file-drop' id='file-drop' multiple required><br>
<input type='submit' value='Загрузить'>
</form>



<div class='message-div message-div_hidden' id='message-div'></div>