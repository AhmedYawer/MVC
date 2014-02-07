<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        //Retreive the project settings from application.ini and pass to view
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $this->view->projectSettings = $config->getOption('projectSettings');
 
    }

    public function indexAction()
    {
        // action body
    }


}

