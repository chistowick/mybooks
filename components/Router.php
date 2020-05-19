<?php

/**
 * Router checks the URL, 
 * routes user requests to the appropriate controller 
 * or to the error page
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

            // URI validation
            $pattern = '~^(\/[\w\.-]+)*\/?$~';
            if (!preg_match($pattern, $_SERVER['REQUEST_URI'])) {
                $this->printErrorPage('URI is not valid');
            }

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

                // If the method does not exist
                if (!method_exists($controller_name, $action_name)) {

                    $this->printErrorPage('method not exists');
                }

                // Creating a controller object and calling the required method.
                $controller_obj = new $controller_name;

                $param_arr = $parts_path; // What's left of the internal route.

                $action_result = call_user_func_array(array($controller_obj,
                    $action_name), $param_arr);

                // If the controller returned false
                if ($action_result === false) {
                    $this->printErrorPage('controller returns false');
                }

                // If the controller and method successfully processed the request 
                if ($action_result != null) {
                    return TRUE;
                }
            }
        }
        // If the route is not found 
        $this->printErrorPage('the route is not found');
    }

    // Returns 404-page
    private function printErrorPage($message) {

//      header("Location: https://www.mrbooks.ru");
        header("HTTP/1.0 404 Not Found");
//        echo $message;
        include_once (ROOT . '/views/errors/404.php');
        exit;
    }

}
