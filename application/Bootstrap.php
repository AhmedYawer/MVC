<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _init() {
        
        die("done");
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginationcontrols.phtml');
        
    }
    
    protected function init() {
        
        
        die("done done");
    }
    
}

