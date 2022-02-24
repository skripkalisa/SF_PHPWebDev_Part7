<?php
require_once dirname(__DIR__, 3). '/vendor/autoload.php';
require_once dirname(__DIR__, 1). '/bootstrap.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
use Monolog\Handler\FirePHPHandler;

// Создаем логгер
$log = new Logger('mylogger');
$warning = fopen(dirname(__DIR__, 1). '/logs/warning.log', "a");
$alert = fopen(dirname(__DIR__, 1). '/logs/alert.log', "a");
$debug = fopen(dirname(__DIR__, 1). '/logs/debug.log', "a");
ErrorHandler::register($log);

$logger = new Logger('debugger');

$logger->pushHandler(new StreamHandler($debug, Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

// Хендлер, который будет писать логи в "mylog.log" и слушать все ошибки с уровнем "WARNING" и выше .
$log->pushHandler(new StreamHandler($warning, Logger::WARNING));

// Хендлер, который будет писать логи в "troubles.log" и реагировать на ошибки с уровнем "ALERT" и выше.
$log->pushHandler(new StreamHandler($alert, Logger::ALERT));
// Добавляем процессор, который добавляет ко всем записям дополнительную информацию.
$log->pushProcessor(function ($record) {
    $record['login']['user'] = 'Logging message';
    return $record;
});

$email_err = isset($_SESSION["email_err"]) ?  $_SESSION["email_err"] : '';
$pass_err = isset($_SESSION["email_err"]) ?  $_SESSION["password_err"] : '';

// Добавляем записи
$log->warning('Предупреждение', ['warning' =>  debug_backtrace(error_reporting(E_WARNING | E_PARSE | E_NOTICE))]);
$log->alert('Большая ошибка', ['email' => $email_err, 'password' => $pass_err ]);
$logger->info('Просто тест', ['info' => debug_backtrace(error_reporting(E_ALL & ~E_NOTICE))]);
