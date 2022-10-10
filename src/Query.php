<?php 
namespace PhpPagination;

class Query{

    private $column ;
    private $table ;
    private $queryLimit;

    /**
     * set columns 
     * @param string|array $column
     * @return  Query
     */
    public function setColumn($column){
        $this->column=$column;
        return $this;
    }
    /**
     * get columns
     * @return  string
     */
    private function getColumn(){

        if(is_string($this->column)){

            return "SELECT " . $this->column;

        }elseif(is_array($this->column)){
            $columns="";
            foreach($this->column as $col){
                $columns.= " , " . $col;
            }
            $columns=  htmlspecialchars($columns);
            return   "SELECT " . trim($columns," , ");
        }


    }

      /**
     * set table 
     * @param string $tableName
     * @return  Query
     */
    public function setTable(string $tableName){
        $this->table=$tableName;
        return $this;
    }
    /**
     * get table
     * @return  string
     */
    public function getTable(){
        return "FROM " . $this->table;
    }

    public function setLimit(string $queryLimit){
        $this->queryLimit=$queryLimit;
        return $this;
    }

    public function getQuery(){
        return $this->getColumn() . " " . $this->getTable() . " " . $this->queryLimit;
    }



   

}
