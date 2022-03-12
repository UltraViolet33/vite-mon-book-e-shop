<?php

require_once('../app/core/controller.php');

class Ajax extends Controller
{
    
    /**
     * index
     * get the data from the js and do the sql queries
     * @return void
     */
    public function index()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        var_dump($data);
    }
}
