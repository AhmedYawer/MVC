<?php

/************** AUTH SERVICE CONSTANTS ***********************/
define("TABLE_USERS","adminusers");
define("LOGIN_IDENTITY_COLUMN", "username");
define("LOGIN_CREDENTIALS_COLUMN", "password");

class Application_Service_Auth {
    
    function authenticate($username, $password) {
    	 
    	$auth = Zend_Auth::getInstance();
    	$adapter = $this->_getAuthAdapter();
    	 
    
    	$adapter = $this->_getAuthAdapter();
    	$adapter->setIdentity($username);
    	$adapter->setCredential($password);
    	$result =  $auth->authenticate($adapter);
    
    	$user = null;
    	if ($result->isValid()) {
    		//Store the user details in storage
    		$user = $adapter->getResultRowObject(); 
    		$user->role='user';
    		$auth->getStorage()->write($user);
    	} else {
            
            //Possibly log authentication errors here
            
        }
    	 
    	return $user;
    	 
    }
    
    
    
    
    
    protected function _getAuthAdapter() {
    
    
    
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    

        //   These defined constants are taken from config.inc.php file
    	$authAdapter->setTableName(TABLE_USERS)
    	->setIdentityColumn(LOGIN_IDENTITY_COLUMN)
    	->setCredentialColumn(LOGIN_CREDENTIALS_COLUMN);

    	return $authAdapter;
    }
    
    
}