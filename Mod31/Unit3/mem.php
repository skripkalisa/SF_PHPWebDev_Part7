<?php
include('func.php');

echo "String memory usage test.\n\n";
$base_memory_usage = memory_get_usage();
$base_memory_usage = memory_get_usage();

echo "Start\n";
memoryUsage(memory_get_usage(), $base_memory_usage);

$a = someBigValue();

echo "String value setted\n";
memoryUsage(memory_get_usage(), $base_memory_usage);

unset($a);

echo "String value unsetted\n";
memoryUsage(memory_get_usage(), $base_memory_usage);
