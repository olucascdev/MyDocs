<?php

class Core
{
  public function run($routes)
  {
    $url = '/';

    if (isset($_GET['url'])) {
      $url .= $_GET['url'];
    } else {
      $url .= ''; // Não é necessário, pois não altera nada
    }

    foreach ($routes as $path => $controller) {
      $pattern = '#^' . preg_replace('/{id}/', '([\w+])', $path) . '$#';

      if (preg_match($pattern, $url, $matches)) {
        array_shift($matches);
        print_r($matches);
        [$currentController, $action] = explode('@', $controller);

        require_once __DIR__ . "/../controller/$currentController.php";
      }
    }
  }
}