<?php
 
class Database
{
  /**
   * Instance de la classe PDO
   *
   * @var PDO
   * @access private
   */ 
  private $PDOInstance = null;
 
   /**
   * Instance de la classe SPDO
   *
   * @var SPDO
   * @access private
   * @static
   */ 
  private static $instance = null;
 
  
  /**
   * Constructeur
   *
   * @param void
   * @return void
   * @see PDO::__construct()
   * @access private
   */
  private function __construct()
  {
    $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
    $this->PDOInstance  = new PDO($string, DB_USER, DB_PASS);
  }
 
   /**
    * Crée et retourne l'objet SPDO
    *
    * @access public
    * @static
    * @param void
    * @return SPDO $instance
    */
  public static function getInstance()
  {  
    if(is_null(self::$instance))
    {
      self::$instance = new Database();
    }
    return self::$instance;
  }
 
  /**
   * Exécute une requête SQL avec PDO
   *
   * @param string $query La requête SQL
   * @return PDOStatement Retourne l'objet PDOStatement
   */
  public function query($query)
  {
    return $this->PDOInstance->query($query);
  }

   /**
     * read
     * read on the BDD
     * @return array
     */
    public function read($query, $data = array())
    {
        $statement = $this->PDOInstance->prepare($query);
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
     * @return bool
     */
    public function write($query, $data = array())
    {
        $statement = $this->PDOInstance->prepare($query);
        $result = $statement->execute($data);

        if ($result) {
            return true;
        }
        return false;
    }

    public function getLastInsertId()
    {
        return $this->PDOInstance->lastInsertId();
    }
}