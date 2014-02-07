<?php

class SetupController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
       
        /*
        * Turn off layout and view rendering
         * The various actions won't try to output a layout 
         * or a view file.
         * Handy when you just want to run a script without setting
         * up view files
        */
        
       $this->_helper->layout->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
       $dbModel = new Application_Model_DbTable_Albums();
        
        //Retrieve all the records - not very efficient in a production environment
        $collectionOfAlbums = $dbModel->fetchAll();
        
        //Assign the collection to a view variable which will be iterated through in /views/scripts/tunes/index.phtml
        $this->view->collectionOfAlbums = $collectionOfAlbums;
    }
    
    public function createalbumsAction() {
        
        $dbModel = new Application_Model_DbTable_Albums();
        
        for($i=0; $i<100; $i++) {
            
            $dbModel->insert(array('artist'=>"Artist $i",'title'=>"Title $i"));
                
        }
        
        
    }
    
    public function createlogfileAction() {
            
        for($i=0; $i < 150; $i++) {
            Application_Model_Logger::logmessage("This is a test messge $i");
            Application_Model_Logger::warn("This is a warning messge $i");
            
            
            $exception = new Zend_Exception('Test exception');
            Application_Model_Logger::err($exception);
            
        }
            
        }
        
        
        
    
    
    

        

        
   
}

