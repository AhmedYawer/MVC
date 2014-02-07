<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
        // action body
        
      //  $username = "john";
      //  $password = "test";
        
      //  $serviceAuth = new Application_Service_Auth();
        
      //  $user = $serviceAuth->authenticate($username, $password);
     
        $form = new Application_Form_Login();
   
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	
        	    $serviceAuth = new Application_Service_Auth();
        	    
        	    //We used form methods to retrieve filtered and sanitised input
        	    $user = $serviceAuth->authenticate($form->getValue("username"), $form->getValue("password"));
        	    
        	    if ($user) {
        	        
        	        //Redirect to the admin section
        	        
        	        $this->_helper->redirector('index', 'admin', null);
        	        
        	        
        	    } else {
                        
                        die("Invalid Login");
                        
                    }
        	    
        		        
        	} else {
        	    
        	    foreach ($form->getMessages() as $message ) {
        	        
        	        print_r($message); 
        	        
        	    } 
        	    
        	    
        	    
        	    die("Invalid Form");
        	} // invalid form
        	
        
        }  else {
            
           
        }
    }
    
    function logoutAction() {
    	//   $a = Zend_Session::destroy( true );//http://stackoverflow.com/questions/10515439/how-to-properly-kill-sessions-in-zend-framework
    	 
    	
    	$auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    
    	$urlOptions = array('controller' => 'index', 'action' => 'index');
    
    	$this->_helper->redirector->gotoRoute($urlOptions);
    
    }


}


