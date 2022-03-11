<?php

class Controller
{
    
    /**
     * view
     * load a view file
     */
    public function view($path, $data = [])
    {
        extract($data);

        if (file_exists("../app/views/" . $path . ".php")) {
            include "../app/views/" . $path . ".php";
        } else {
            include "../app/views/404.php";
        }
    }
    
    /**
     * loadModel
     * load a model file
     */
    public function loadModel($model)
    {
        if (file_exists("../app/models/" .  strtolower($model) . ".php")) {
            include "../app/models/" . strtolower($model) . ".php";
            return $a = new $model();
        }
        return false;
    }
}
