<?php
  /*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{

    // Set default values for displaying home page.
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {

    $url = $this->getUrl();

      // Look in controllers for first value.
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        // If exists, set as controller
      $this->currentController = ucwords($url[0]);
        // Unset 0 Index
      unset($url[0]);
    }

      // Require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

      // Instantiate controller class
    $this->currentController = new $this->currentController;

      // Check for second part of url
    if (isset($url[1])) {
        // Check to see if method exists in controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
          // Unset 1 index
        unset($url[1]);
      }
    }

      // Get params
    $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params. The first paramater here is a callable
      // index 0 refers to the object and index 1 refers to the specific method. params
      // is the associative array that will be passed in as parameters.
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl()
  {
      //If a valid url is received. Create an array that contains:
      //[0] - The controller of concern
      //[1] - The specific method
      //[3-n] - The parameters to be supplied to the method.
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}

