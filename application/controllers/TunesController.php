<?php

class TunesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //Declare the model
        $dbModel = new Application_Model_DbTable_Albums();
        
        //Retrieve all the records - not very efficient in a production environment
        $collectionOfAlbums = $dbModel->fetchAll();
        
        //Assign the collection to a view variable which will be iterated through in /views/scripts/tunes/index.phtml
        $this->view->collectionOfAlbums = $collectionOfAlbums;
        
        
    }

    
    
    

}

