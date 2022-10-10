<?php 
namespace PhpPagination;

use Exception;

class Pagination extends Limit{
    private  $table;
    private  $column=[];
    private  $where;
    private  $join;
    private  $orderBy;
    private  $db_host;
    private  $db_name;
    private  $db_user;
    private  $db_password;
    private  $count_page;

    private $limit;





    /**
     * get config database
     * @param array $config
     * @param string|int $pageSize
     * 
     */
    
    public function __construct(array $config , $count_page=20)
    {
       
        $keys=["db_host","db_name","db_user","db_password"];
        foreach($keys as $val){
            if(!isset($config[$val])){
                throw new Exception("There must be a key named [".$val."] in the database array");
            }
        }
        $this->db_host      =htmlspecialchars($config['db_host']);
        $this->db_name      =htmlspecialchars($config['db_name']);
        $this->db_user      =htmlspecialchars($config['db_user']);
        $this->db_password  =htmlspecialchars($config['db_password']);

        $this->count_page=$count_page;
       
        
    }
    /**
     * set table name
     * @param string $tableName
     * @return Pagination
     */
    public  function  table(string $tableName):Pagination{
        $this->table=htmlspecialchars($tableName);
        return $this;
    }

    /**
     * set columns
     * @param string|array $column
     * @return Pagination
     */
    public  function column($column):Pagination{
        $this->column=$column;
        return $this;

    }

    /**
     * get data
     * @return array
     */

    public function get():array{
       return $this->database()
                    ->setStm($this->getQuery())
                    ->get();

   

    }
    /**
     * get first data
     * @return array
     */

    public function first():array{
        return $this->database()
                    ->setStm($this->getQuery())
                    ->first();
    }

    /**
     * connection and set config to  database
     * @return Database
     */
    private function database():Database{
        $db = new Database();
        return $db->setDBHost($this->db_host)
                ->setDBName($this->db_name)
                ->setDBUser($this->db_user)
                ->setDBPassword($this->db_password);
    }



    /**
     * get query
     * @return string
     */
    private function getQuery():string{
        $query = new Query;
        $limit = new Limit($this->count(),$this->count_page);
        return $query->setTable($this->table)
                    ->setColumn($this->column)
                    ->setLimit($limit->queryLimit())
                    ->getQuery();

    }

    /**
     * get count
     * @return string
     */
    private function count(){
        return $this->database()->count($this->table);
    }

    public function prevPage(){
        
        $prevPage=$this->limit()->page - 1;
        $prevPage= $prevPage? $prevPage:1;
        return "?page=" .(string) $prevPage;
    }

    public function nextPage(){
        
        $nextPage=$this->limit()->page + 1;
        $nextPage=$nextPage>$this->limit()->pages?$nextPage-1:$nextPage;
        return "?page=" .(string) $nextPage;
    }

    public function firstPage(){
        return "?page=1" ;
    }

    public function lastPage(){
        $lastPage=$this->limit()->pages;
        return "?page=" .(string) $lastPage;
    }

    private function limit(){
       return  new Limit($this->count(),$this->count_page);
    }

    public function currentPage(){
        return $this->limit()->page;
    }

    public function countPages(){
        return $this->limit()->pages;
    }


    


    




}