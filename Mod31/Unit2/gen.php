<?php

function getRange($max = 10)
{
    $array = [];
    for ($i = 1; $i<= $max; $i++) {
        $array[] = $i;
    }
    return $array;
}

foreach (getRange(15) as $range) {
    echo "Dataset {$range} 
";
}
