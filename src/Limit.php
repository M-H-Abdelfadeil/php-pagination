<?php 
namespace PhpPagination;
class Limit{

    private $limit;
    private $offset;
    public $page;
    public $pages;

    public function __construct($countAll,$countPage){
        $total = $countAll;
        $limit_page = $countPage;
        $pages = ceil($total / $limit_page);
        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));

        $offset = ($page - 1)  * $limit_page;
        $this->limit=$limit_page;
        $this->offset=$offset;
        $this->page=$page;
        $this->pages=$pages;
        

       

    }

    public function queryLimit(){
        return " LIMIT " . $this->limit . " OFFSET " . $this->offset;
    }

    



}