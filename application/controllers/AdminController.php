<?php

class AdminController extends Zend_Controller_Action
{

    /*
     * The init() function is called before any action
     * Here we check if the user is authenticated and if not, redirect to main
     * page
     * Note, assuming there is only one type of user / role => admin
     * Otherwise we would have to check on role as well.
     */
    public function init()
    {
        /* Initialize action controller here */
        
          
        $auth = Zend_Auth::getInstance(); 
        if (!$auth->hasIdentity()) {
            $urlOptions = array('controller' => 'index', 'action' => 'index');
            $this->_helper->redirector->gotoRoute($urlOptions);
        }
    }

    public function indexAction()
    {
       $dbModel = new Application_Model_DbTable_Albums();
       
       $paginator = $dbModel->fetchAllPaginated();
       
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        
      //  $this->view->paginator = $paginator;
        //Retrieve all the records - not very efficient in a production environment
       // $collectionOfAlbums = $dbModel->fetchAll();
        
        //Assign the collection to a view variable which will be iterated through in /views/scripts/tunes/index.phtml
        $this->view->collectionOfAlbums = $paginator;
    }
    
    
    
    public function addalbumAction() {
        
        $form = new Application_Form_Album();
        
        $this->view->form = $form;
      
        if ($this->getRequest()->isPost()) {
            //Assign all the POST variables to an array
        	$formData = $this->getRequest()->getPost();
        	//Pass the array to the form's validation function
        	if ($form->isValid($formData)) {
        	    //If the data is valid, it will be filtered and assigned to the correct form variable
        		$artist = $form->getValue('artist');
        		$title = $form->getValue('title');
        		
        		//Create an object from the Album modle
        		$albums = new Application_Model_DbTable_Albums();
        		
        		//Pass the validated form values to the model
        		$albums->addAlbum($artist, $title);
        		
        		//Once done, return to the index
        		$this->_helper->redirector('index');
        	} else {
        	    
        	    //for this version, just dump any errors encountered.
        	    echo "<p>There was an error submitting the form";
        	    
        	    print_r($form->getErrors());
        	    
        	    die("Form Submission Error");
        		
        	}
        }
        
        
        
     
        
    }


    public function updatealbumAction() {
        
        $form = new Application_Form_Album(true);//pass value of true to indicate update
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist, $title);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->getAlbum($id));
            }
    }
        

        
    }
    
   public function deleteAction() {
       
       if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $albums = new Application_Model_DbTable_Albums();
            $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
   }
   
   public function viewlogsAction() {
       
       $dbModel = new Application_Model_DbTable_Logfile();
       
       $paginator = $dbModel->fetchAllPaginated();
       
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        
      //  $this->view->paginator = $paginator;
        //Retrieve all the records - not very efficient in a production environment
       // $collectionOfAlbums = $dbModel->fetchAll();
        
        //Assign the collection to a view variable which will be iterated through in /views/scripts/tunes/index.phtml
        $this->view->paginator = $paginator;
       
   }
   
   public function deletelogentryAction() {
       
       //Retrieve the parameter sent either by POST or GET
       //Default to 0 if not sent and cast to an integer
        $log_id = (int) $this->getRequest()->getParam('id',0);
        
        //Set a default array message which is passed at end of function
        // key 'status' == 1 => success
        // key 'status' == 0 => failure
        $actionResultMessage = array('status'=>0,'message'=>'');
        
       // Only process if log_id is greater than 0
        //Modify the $actionResultMesage depending on what happens
        if ($log_id > 0 ) {
            
        $dbTable = new Zend_Db_Table('app_logfile');
        
        try { //Attempa try
            $dbTable->delete('log_id = ' . $log_id);
            //
             $actionResultMessage = array('status'=>1,'message'=>'Record Deleted');
        }
        catch (Exception $e) { // Catch errors, in production, you would not display the error message
             $actionResultMessage = array('status'=>0,'message'=>$e->getMessage());
        }
        
        }
        
        //Return the $actionResultMessage as a json entry
       $this->_helper->json($actionResultMessage);
       
       
   }
   
   public function viewlogentryAction() {
       
       
   }
   
  
    
}

