<?php

/**
 * Description of Router
 *
 * @author Tolya and Nastya
 */
class Router {

    private $routes;

    // Getting an array of all routes.
    public function __construct() {
        $routes_path = ROOT . '/config/routes.php';
        $this->routes = include($routes_path);
    }

    // Returns a query string
    private function getURI() {

        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {

        // Getting a query string
        $uri = $this->getURI();

        // Checking the query string in routes.php
        foreach ($this->routes as $uri_pattern => $path) {
            if (preg_match("~$uri_pattern~", $uri)) {

                // Forming an internal route with parameters from the URI
                $internal_route = preg_replace("~$uri_pattern~", $path, $uri);
                
                // Deciding which controller and method will process the request
                $parts_path = explode('/', $internal_route);

                $controller_name = array_shift($parts_path) . 'Controller';
                $controller_name = ucfirst($controller_name);

                $action_name = 'action' . ucfirst(array_shift($parts_path));

                // Connecting a controller-class file.
                $controller_file = ROOT . '/controllers/' . $controller_name . '.php';

                if (file_exists($controller_file)) {
                    include_once($controller_file);
                }
                
                // Creating a controller object and calling the required method.
                $controller_obj = new $controller_name;

                $param_arr = $parts_path; // What's left of the internal route.

                $action_result = call_user_func_array(array($controller_obj,
                    $action_name), $param_arr);

                if ($action_result != null) {
                    break;
                }
            }
        }
    }

}
