<?php 
class Application_Model_DbTable_Logfile extends Zend_Db_Table_Abstract
{

    protected $_name = 'app_logfile';
    
    
    public function fetchAllPaginated() {
        
       //  $select = $db->select()->from('posts')->sort('date_created DESC');
 
        // Create a Paginator for the blog posts query
        
        $paginator = Zend_Paginator::factory($this->select());
        
        // $select = $db->select()->from('posts')->sort('date_created DESC');
 
        // Create a Paginator for the blog posts query
      
        
          return $paginator;  
        
    }

}

?>

