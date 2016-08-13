<?php

class LogoutController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		Zend_Session::namespaceUnset('members');
		$this->_redirect('/auth');
    }


}

