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

    ($url != '/') ? $url = rtrim($url, '/') : $url;

    $routerFound = false;

    foreach ($routes as $path => $controller) {
      $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

      if (preg_match($pattern, $url, $matches)) {
        array_shift($matches);

        $routerFound = true;


        [$currentController, $action] = explode('@', $controller);


        require_once __DIR__ . "/../src/controllers/$currentController.php";

        $newController = new $currentController();
        $newController->$action($matches);
      }
    }
    if (!$routerFound) {
      require_once __DIR__ . "/../src/controllers/NotFoundController.php";
      $controller = new NotFoundController();
      $controller->index();
    }
  }
}