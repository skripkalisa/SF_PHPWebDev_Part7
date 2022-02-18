<?php
include_once 'HtmlIterator.php';

$file = __DIR__.'/source/code.html';
$new_file = __DIR__.'/target/code.html';

$html = new HtmlIterator($file);

foreach ($html as $key => $row) {
    if (str_contains($row, '<title>')) {
        continue;
    }
    if (str_contains($row, '<meta')) {
        if (str_contains($row, 'keywords') || str_contains($row, 'description')) {
            continue;
        }
    }
    // print_r($key);
    // print_r($row);
    file_put_contents($new_file, $row, FILE_APPEND | LOCK_EX);
}

echo PHP_EOL;
