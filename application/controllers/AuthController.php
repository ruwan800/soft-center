<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
		$this->userns	= new Zend_Session_Namespace('members');
	    $this->db		= Zend_Db_Table::getDefaultAdapter();
		$this->model	= new Application_Model_User();
	  	$this->form		= new Application_Form_Auth();
		$this->auth		= Zend_Auth::getInstance();
    }

    public function indexAction(){
    
#		$auth   = Zend_Auth::getInstance();
		if ($this->auth->getIdentity()){
			$this->_redirect('/');
			return;
		}
    	$this->view->form = $this->form;
	}

	public function formAction(){

#	    $db = Zend_Db_Table::getDefaultAdapter();

	    if ($this->form->isValid($_POST)) {
 
	        $adapter = new Zend_Auth_Adapter_DbTable(
	            $this->db,
	            'users',
	            'name',
	            'password'
	            );
 
 			$userName = $this->form->getValue('username');
	        $adapter->setIdentity($userName);
	        $adapter->setCredential($this->form->getValue('password'));
 
#			$auth   = Zend_Auth::getInstance();
	        $result = $this->auth->authenticate($adapter);
 
	        if ($result->isValid()) {
				$this->userns->userName = $userName ;
	        	$this->model->setUser();
	            $this->_redirect('/');
	            return;
	        }
	        else{
	        	$this->view->form = "<p><b>Incorrect username or password. Please Try again.</b><p></br></br>".$this->form;
	    		$this->render('index');
	        	return;
	        }
	    }
    }

    public function logoutAction()
    {
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		Zend_Session::namespaceUnset('members');
    	$this->view->form = $this->form;
		$this->render('index');
    }

}

