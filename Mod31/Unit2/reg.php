<?php

// класс хранилища данных, реализующий интерфейс Iterator
class Registry implements Iterator
{
    // массив, в котором хранятся настройки
    private $options = [];

    // возвращает текущий элемент
    public function current()
    {
        return current($this -> options);
    }

    // возвращает ключ текущего элемента
    public function key()
    {
        return key($this -> options);
    }

    // передвигаемся вперед на один элемент
    public function next()
    {
        next($this -> options);
    }

    // возвращает указатель на начало массива
    // фактически мы начинаем считать заново с нуля
    public function rewind()
    {
        reset($this -> options);
    }

    // проверяет, достигли ли мы конца массива
    public function valid()
    {
        return current($this -> options) !== false;
    }

    // метод для добавления настройки в хранилище
    public function set($option, $value)
    {
        $this -> options[$option] = $value;
        return $this;
    }

    // метод для получения настройки из хранилища
    public function get($option)
    {
        return $this -> options[$option];
    }
}
// создали объект
$reg = new Registry();

// добавили настройки
$reg -> set("DS", DIRECTORY_SEPARATOR)
    -> set("APP_HOME", '.')
    -> set("AUTO_RELOAD", true);


// и прошлись по настройкам.
// обратите внимание - никаких массивов, только объект $reg

foreach ($reg as $option => $value) {
    echo $option. " = ". $value. PHP_EOL;
}
