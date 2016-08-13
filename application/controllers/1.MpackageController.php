<?php

class MpackageController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model	= new Application_Model_Mpackage();
      	$this->nssearch	= new Zend_Session_Namespace('search');
      	$this->nspkg	= new Zend_Session_Namespace('mpackage');
    }

    public function indexAction()
    {
        // just render view/index.phtml page
    }

	public function addbyjobAction()
	{
    	$values = $this->getAllValues();
		$this->model->addByJobType($values[0],$values[1]);
		$this->view->message = "User '{$values[0]}' added to the '{$values[1]}' team successfully.";
		$this->render('index');
	}

	public function delbyjobAction()
	{
		
	}

	public function addbyteamAction()
	{
		
	}

	public function delbyteamAction()
	{
		
	}

	public function packageAction()
	{
		$this->_forward($this->nspkg->action);
	}

	public function getAllValues()
	{
		if( ! isset($this->nspkg->type)){
			$value = $this->_getParam('value', Null);
			if($value){
				$this->nspkg->type = $value;
			}
			else{
				if( ! isset($this->nspkg->action)){
					$this->nspkg->action = $this->getRequest()->getActionName();
				}
				$this->getValue();
				return;
			}
		}
		if( ! isset($this->nspkg->package)){
			$value = $this->_getParam('value', Null);
			if($value){
				$this->nspkg->package = $value;
			}
			else{
				$this->getValue();
				return;
			}
		}
		$result = array($this->nspkg->type,$this->nspkg->package);
		Zend_Session::namespaceUnset('mpackage');
		Zend_Session::namespaceUnset('search');
		return $result;
	}

	public function getValue()
	{
		$this->nssearch->controller = 'mpackage';
		$this->nssearch->action = $this->getRequest()->getActionName();
		$this->_forward('index','search');
	}
}

