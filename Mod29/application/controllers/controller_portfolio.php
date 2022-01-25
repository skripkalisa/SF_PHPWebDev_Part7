<?php
$path = dirname(__DIR__) . "/core/controller.php";
require_once "$path";
require_once  dirname(__DIR__) . "/models/model_portfolio.php";
class Controller_Portfolio extends Controller
{
  function action_index()
  {
    $data = new Model_Portfolio;

    $this->view->generate('portfolio_view.php', 'template_view.php', $data->get_data());
  }
}
