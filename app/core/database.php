<?php

class Database
{

    public static $con;

    /**
     * __construct
     * connexion to the BDD
     */
    public function __construct()
    {
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$con = new PDO($string, DB_USER, DB_PASS);
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$con)) {
            $a  = new self();
        }

        return self::$con;
    }

    public static function newInstance()
    {
        return $instance = new self();
    }


    /**
     * read
     * read on the BDD
     */
    public function read($query, $data = array())
    {
        $statement = self::$con->prepare($query);
        $result = $statement->execute($data);

        if ($result) {

            $data = $statement->fetchAll(PDO::FETCH_OBJ);

            if (is_array($data) && count($data) > 0) {
                return $data;
            }
        }

        return false;
    }

    /**
     * write
     * write on the BDD
     */
    public function write($query, $data = array())
    {
        $statement = self::$con->prepare($query);
        $result = $statement->execute($data);

        if ($result) {
            return true;
        }

        return false;
    }
}
