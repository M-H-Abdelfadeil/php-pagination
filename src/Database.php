<?php
namespace PhpPagination;
use PDO;
class Database{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $stm;
    public $conn;

    /**
     * set database hosting
     * 
     * @param mixed $host
     * 
     * @return Database
     */
    public function setDBHost(string $host){
        $this->db_host= $host;
        return $this;
    }


     /**
     * set database name
     * 
     * @param mixed $name
     * 
     * @return Database
     */
    public function setDBName(string $name){
        $this->db_name= $name;
        return $this;
    }


     /**
     * set database username
     * 
     * @param mixed $username
     * 
     * @return Database
     */
    public function setDBUser(string $user){
        $this->db_user= $user;
        return $this;
    }

     /**
     * set database password
     * 
     * @param mixed $password
     * 
     * @return Database
     */
    public function setDBPassword(string $password){
        $this->db_pass= $password;
        return $this;
    }

    /**
     * connection database
     * 
     * @param mixed $password
     * 
     * @return PDO
     */

    public function conn(){
        try{

            return new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC    
            ) 
            );
        }catch(\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }

   /**
     * set query  database
     * 
     * @param mixed $stm
     * 
     * @return Database
     */

    public function setStm(string $stm){
        $this->stm= $stm;
        return $this;
    }


    /**
     * get data from table
     * 
     * @return array
     */

    public function get(){
        $query = $this->conn()->prepare($this->stm);
        $query->execute();
        return $query->fetchAll();

    }

    /**
     * get first data from table
     * 
     * @return array
     */
    public function first(){
       
        $query = $this->conn()->prepare($this->stm);
        $query->execute();
        return $query->fetch();
    }


    /**
     * get count records in table
     * 
     * @param string $tableName
     * 
     * @return array
     */
    public function count(string $tableName){
        $query = $this->conn()->prepare("SELECT COUNT(*) FROM ".$tableName);
        $query->execute();
        return $query->fetchColumn();
    }
    

}