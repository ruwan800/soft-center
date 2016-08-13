<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$auth   = Zend_Auth::getInstance();
		if ($auth->getIdentity()){
			$this->_redirect('/');
			return;
		}
		
	    $db = Zend_Db_Table::getDefaultAdapter();

	    $loginForm = new Application_Form_Auth();
 
	    if ($loginForm->isValid($_POST)) {
 
	        $adapter = new Zend_Auth_Adapter_DbTable(
	            $db,
	            'user_settings',
	            'usr_e_mail',
	            'usr_passwd'
	            );
 
	        $adapter->setIdentity($loginForm->getValue('username'));
	        $adapter->setCredential($loginForm->getValue('password'));
 
#			$auth   = Zend_Auth::getInstance();
	        $result = $auth->authenticate($adapter);
 
	        if ($result->isValid()) {
	            $this->_helper->FlashMessenger('Successful Login');
	            $this->_redirect('/');
	            return;
	        }
	        else{
	        	$this->view->form = "<b>Incorrect username or password. Please Try again.</b></br></br>".$loginForm;
	        	return;
	        }
 
	    }
    	$this->view->form = $loginForm;
    }

}

