<?php

class PkgrequestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
        $requestForm = new Application_Form_Request();
        if ($requestForm->isValid($_POST)) {
        	
#        	$request['id'] = $requestForm->getValue('emid');
        	$request['rqsted_usr'] = $requestForm->getValue('username');
        	$request['rqst_log_msg'] = $requestForm->getValue('softname');
        	$request['rqst_log_status'] = $requestForm->getValue('updates');
        	$newRequest = new Application_Model_Pkgrequest($request);
        	$result = $newRequest->newRequest();
        	$this->_redirect('/');
        }
        else{
        	$this->view->form = $requestForm;
        }
        
    }


}

