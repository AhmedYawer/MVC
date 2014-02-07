<?php

/**
 * Description of Logger
 *
 * @author john
 */
class Application_Model_Logger {
    //put your code here
    
    public static function logmessage($message) {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
			
	$params = $config->resources->db->params;
	$db = Zend_Db::factory('PDO_MYSQL', $params);
				
        $columnMapping = array('priority' => 'priority', 'log_message' => 'message');
        $writer = new Zend_Log_Writer_Db($db, 'app_logfile', $columnMapping);
				
        $logger = new Zend_Log($writer);
				
	$logger->info($message);
		
	}
        
        
    public static function warn($message) {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
			
	$params = $config->resources->db->params;
	$db = Zend_Db::factory('PDO_MYSQL', $params);
				
        $columnMapping = array('priority' => 'priority', 'log_message' => 'message');
        $writer = new Zend_Log_Writer_Db($db, 'app_logfile', $columnMapping);
				
        $logger = new Zend_Log($writer);
				
	$logger->warn($message);
		
	}
        
        
    public static function err($exception) {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
			
	$params = $config->resources->db->params;
	$db = Zend_Db::factory('PDO_MYSQL', $params);
				
        $columnMapping = array('priority' => 'priority', 'log_message' => 'message');
        $writer = new Zend_Log_Writer_Db($db, 'app_logfile', $columnMapping);
				
        $logger = new Zend_Log($writer);
				
	$logger->err($exception);
		
	}
    
    
}

?>
