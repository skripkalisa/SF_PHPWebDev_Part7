<?php


class Route
{
  public static function start()
  {
    // контроллер и действие по умолчанию
    $controller_name = 'main';
    $action_name = 'index';
    // $routes = $_GET['url'];
    $routes = explode('/', $_SERVER['REQUEST_URI']);


    if (!empty($routes[1])) {
      $controller_name = $routes[1];
    }
    // получаем имя экшена
    if (!empty($routes[2])) {
      $action_name = $routes[2];
    }
    // var_dump($routes);
    // die();
    // добавляем префиксы
    $model_name = 'model_' . $controller_name;
    // var_dump($model_name);
    $controller_name = 'controller_' . $controller_name;
    // var_dump($controller_name);
    $action_name = 'action_' . $action_name;
    // var_dump($action_name);

    // подцепляем файл с классом модели (файла модели может и не быть)
    $model_file = strtolower($model_name) . '.php';
    // var_dump($model_file);
    $model_path = "application/models/" . $model_file;
    if (file_exists($model_path)) {
      include "application/models/" . $model_file;
    }

    // подцепляем файл с классом контроллера
    $controller_file = strtolower($controller_name) . '.php';
    // var_dump($controller_file);
    $controller_path = "application/controllers/" . $controller_file;
    // var_dump($controller_path);
    if (file_exists($controller_path)) {
      include "application/controllers/" . $controller_file;
    } else {

      (new Route)->ErrorPage404();
      // echo "Junk!!!!";
    }

    // создаем контроллер
    $controller = new $controller_name;
    // var_dump($controller);
    // print_r($controller);
    // echo "<br />";
    $action = $action_name;
    // var_dump($action);
    // echo "<br />";
    // die();

    if (method_exists($controller, $action)) {
      // вызываем действие контроллера
      $controller->$action();
    } else {
      (new Route)->ErrorPage404();
      // echo "Junk!!!!";

    }
    // die();
  }
  function ErrorPage404()
  {
    $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:' . $host . '404');
    echo "Junk!!!!";
  }
}