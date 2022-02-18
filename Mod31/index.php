<?php
include_once 'HtmlIterator.php';

$file = __DIR__.'/source/code.html';

if (!file_exists(__DIR__.'/target/')) {
    mkdir(__DIR__.'/target/', 0777, true);
}
$_file = fopen(__DIR__.'/target/code.html', "w") or die("Unable to open file!");
$new_file = stream_get_meta_data($_file)["uri"];

$bracket = '<';
$title = 'title';
$meta = 'meta';
$meta_tag1 = 'keywords';
$meta_tag2 = 'description';


$html = new HtmlIterator($file);

foreach ($html as $key => $row) {
    if (str_contains($row, $bracket.$title)) {
        continue;
    }
    if (str_contains($row, $bracket.$meta)) {
        if (str_contains($row, $meta_tag1) || str_contains($row, $meta_tag2)) {
            continue;
        }
    }
    // Раскомментируйте эти команды чтобы посмотреть вывод в консоль:
    // print_r($key);
    // print_r($row);
    file_put_contents($new_file, $row, FILE_APPEND | LOCK_EX);
}
fclose($_file);
echo PHP_EOL;
