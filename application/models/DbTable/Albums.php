<?php 
class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{

    protected $_name = 'albums';
    
    public function getAlbum($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        // Uncomment if you want to debug array contents coming back
        //die(print_r($row->toArray)); 
        return $row->toArray();
}
       

    

    public function addAlbum($artist, $title)
    {
        $data = array(
            'id'=>null, //pass null id, so we get record id back
            'artist' => $artist,
            'title' => $title,
        );
        $record_id = $this->insert($data);
    }
    
    public function updateAlbum($id, $artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title' => $title,
        );
        
        $this->update($data, 'id = '. (int)$id);
    }
    
    public function deleteAlbum($id)
    {
        
        $this->delete('id =' . (int)$id);
    }
    
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

