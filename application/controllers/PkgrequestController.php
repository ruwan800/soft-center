<?php

class PkgrequestController extends Zend_Controller_Action
{

    public function init()
    {
        $this->form = new Application_Form_Request();
       	$this->model= new Application_Model_Pkgrequest();
    }

    public function formAction()
    {
        
        $requestForm = new Application_Form_Request();
        if ($this->form->isValid($_POST)) {
        	
#        	$request['id'] = $requestForm->getValue('emid');
        	$request['rqsted_usr'] = $this->form->getValue('username');
        	$request['rqst_log_msg'] = $this->form->getValue('softname');
        	$request['rqst_log_status'] = $this->form->getValue('updates');
        	$result = $this->model->newRequest($request);
        	$this->_redirect('/');
        }
        else{
        
        	$this->view->form = $this->form;
    		$this->render('index');
        	
        }

    }

	public function indexAction(){
	
		$package = $this->_getParam('package', False);
		$userns	= new Zend_Session_Namespace('members');
		$user = $userns->userName;
		$this->form->softname->setvalue($package);
		$this->form->username->setvalue($user);
        $this->view->form = $this->form;

	}

}

