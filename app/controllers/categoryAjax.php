<?php

require_once('../app/core/controller.php');

class CategoryAjax extends Controller
{
    public $category;

    public function __construct()
    {
        $this->category = $this->loadModel('Category');
    }

    /**
     * index
     * get the data from the js and do the sql queries
     * @return void
     */
    public function index()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        if (is_object($data) && isset($data->dataType)) {

            if ($data->dataType == "addCategory") {
                $this->createCategory($data);
            }
        }
    }


    private function createCategory($data)
    {
        $result = $this->category->create($data);
        if ($result) {
            $arr['message'] = "Insertion OK";
            $arr['messageType'] = "info";
            $categories = $this->category->getAll();
            $arr['data'] = $this->category->makeTable($categories);
            $arr['dataType'] = "addCategory";
            echo json_encode($arr);
        } else {
            $arr['message'] = $_SESSION['error'];
            unset($_SESSION['error']);
            $arr['messageType'] = "error";
            $arr['data'] = "";
            $arr['dataType'] = "addCategory";
            echo json_encode($arr);
        }
    }
}
