<?php

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params;
    
    /**
     * __construct
     * extract the current URL and load the good controller with the good method
     */
    public function __construct()
    {
        $url = $this->parseURL();
        //show($url);

        //check if the file exists
        if (file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
            $this->controller = ($url[0]);
            unset($url[0]);
        }

        require("../app/controllers/" . $this->controller . ".php");
        $this->controller = new $this->controller;

        // if there is a method in the URL
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = (count($url) > 0) ? $url : ["home"];
        // load the method of the controller
        call_user_func_array([$this->controller, $this->method], $this->params);
        // show(array_values($url));
    }
    
    /**
     * parseURL
     * @return the URL
     */
    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}
