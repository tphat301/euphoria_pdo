<?php

class Routers
{
  private static $routers = array();
  /* Handle abort status code */
  public static function abort($statusCode = 404)
  {
    $base = rtrim(Configurations::configurationsBase()['baseUrl'], '/');
    http_response_code($statusCode);
    echo "<link rel=\"stylesheet\" href=\"$base/public/scss/output.scss\">
      <section class=\"flex items-center justify-center h-screen p-16 bg-gray-50 dark:bg-gray-700\">
        <div class=\"container flex flex-col items-center \">
          <div class=\"flex flex-col gap-6 max-w-md text-center\">
            <h2 class=\"font-extrabold text-9xl text-gray-600 dark:text-gray-100\">
              <span class=\"sr-only\">Error</span>404
            </h2>
            <p class=\"text-2xl md:text-3xl dark:text-gray-300\">Sorry, we couldn't find this page.</p>
            <a href=\"$base\" class=\"px-8 py-4 text-xl font-semibold rounded bg-purple-600 text-gray-50 hover:text-gray-200\">Back to home</a>
          </div>
        </div>
      </section>";
    die();
  }

  /* Handle uri request */
  private static function uriRequest()
  {
    $configUrl = Configurations::configurationsBase()['url'];
    $uri = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'])['path'] : '/';
    $uri = str_replace($configUrl, '/', $uri);
    return $uri;
  }

  /* Handle method request */
  private static function methodRequest()
  {
    return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
  }

  /* Router with GET Method */
  public static function get($url, $action)
  {
    Routers::$routers[] = array(
      'url' => $url,
      'action' => $action,
      'method' => 'GET'
    );
  }

  /* Router with POST Method */
  public static function post($url, $action)
  {
    Routers::$routers[] = array(
      'url' => $url,
      'action' => $action,
      'method' => 'POST'
    );
  }

  private static function combieString($action = "")
  {
    $actionArray = explode('@', $action);
    if (count($actionArray) !== 2) {
      die('Router not valid!');
    }
    $controllerName = $actionArray[0];
    $namespace = "App\\Controllers";
    $classController = "$namespace\\$controllerName";
    $methodName = $actionArray[1];
    $pathController = "app/controllers/" . $controllerName . ".php";
    if (file_exists($pathController)) {
      require_once($pathController);
    } else {
      die("$pathController is not found or not exist!");
    }
    if (class_exists($classController)) {
      $controller = new $classController;
      if (method_exists($controller, $methodName)) {
        $controller->$methodName();
      } else {
        die('This is not found method controller or this is method controller not exist!');
      }
    } else {
      die('This is not found class controller or this is class controller not exist!');
    }
  }

  private static function combieArray($action = array())
  {
    if (count($action) !== 2) {
      die('Router not valid!');
    }
    $controllerName = $action[0];
    $namespace = "App\\Controllers";
    $classController = "$namespace\\$controllerName";
    $methodName = $action[1];
    $pathController = "app/controllers/" . $controllerName . ".php";
    if (file_exists($pathController)) {
      require_once($pathController);
    } else {
      die("$pathController is not found or not exist!");
    }
    if (class_exists($classController)) {
      $controller = new $classController;
      if (method_exists($controller, $methodName)) {
        $controller->$methodName();
      } else {
        die('This is not found method controller or this is method controller not exist!');
      }
    } else {
      die('This is not found class controller or this is class controller not exist!');
    }
  }

  public static function route()
  {
    $uriRequest = Routers::uriRequest();
    $methodRequest = Routers::methodRequest();
    if (isset(Routers::$routers) && count(Routers::$routers)) {
      foreach (Routers::$routers as $router) {
        if (strtolower($uriRequest) === strtolower($router['url']) && $methodRequest === $router['method']) {
          if (is_callable($router['action'])) {
            return $router['action']();
          } else if (is_string($router['action'])) {
            return Routers::combieString($router['action']);
          } elseif (is_array($router['action'])) {
            return Routers::combieArray($router['action']);
          }
        }
      }
    }
    Routers::abort();
  }
}
