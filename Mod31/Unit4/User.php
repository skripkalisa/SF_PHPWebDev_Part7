<?php

class User
{
    private $name;

    private $pas;
    public static $countConnect = 0;
    public $host = 'localhost';
    public $dbname = 'test';

    public function __construct($name, $pas)
    {
        $this->name = $name;
        $this->pas = $pas;

        $db = new Db();
        $db->check($this->name, $this->pas, $this->fallback());
    }
    
    public function get($text)
    {
        echo $text;
    }
    public function fallback()
    {
        $host = $this->host;
        $dbname = $this->dbname;
        $countConnect = self::$countConnect;

        $fallback = function ($start) use ($host, $dbname, $countConnect) {
            $this->get($start);
            self::$countConnect++;
            return ['host' => $host, 'dbname' => $dbname, 'countConnect' => $countConnect];
        };
        return $fallback;
    }
}

class Db
{
    const GO = 'Старт!.. ';

    public function connect($name, $config)
    {
        echo 'Соединяю пользователя ' . $name;
        echo ' ' . $config['countConnect'] . '... ';
        echo 'Настройки: ' . $config['host'] . ', ' . $config['dbname'];
        echo '<br>';
    }

    public function check($name, $pas, Closure $fallback)
    {
        if ($name != 'admin' || $pas != '123') {
            echo 'Неверный логин или пароль.<br>';
            return false;
        }
        $config = $fallback(self::GO); // отложенное выполнение кода. Результат сохраняем
        $this->connect($name, $config); //результат выполнения (массив)передаем
    }
}
$user1 = new User('admin', 123);
$user1 = new User('admin', 555);
$user1 = new User('admin', 123);
$user1 = new User('admin', 123);

echo PHP_EOL;
