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
		$this->view->message = "Package '{$values[1]}' added to the '{$values[0]}' job category successfully.";
		$this->render('index');
	}

	public function delbyjobAction()
	{
    	$values = $this->getAllValues();
		$this->model->delByJobType($values[0],$values[1]);
		$this->view->message = "User '{$values[0]}' added to the '{$values[1]}' team successfully.";
		$this->render('index');
	}

	public function addbyteamAction()
	{
    	$values = $this->getAllValues();
		$this->model->addByTeamType($values[0],$values[1]);
		$this->view->message = "User '{$values[0]}' added to the '{$values[1]}' team successfully.";
		$this->render('index');
	}

	public function delbyteamAction()
	{
    	$values = $this->getAllValues();
		$this->model->delByTeamType($values[0],$values[1]);
		$this->view->message = "User '{$values[0]}' added to the '{$values[1]}' team successfully.";
		$this->render('index');
	}

	public function packageAction()
	{
		$this->_forward($this->nspkg->action);
	}

	public function getAllValues()
	{
		if( ! isset($this->nspkg->action)){
			$this->nspkg->action = $this->getRequest()->getActionName();
		}
		$type = $this->_getParam('type', Null);
		if ($type){
			$this->nspkg->type = $type;
			$this->nssearch->type = $type;
		}
		if(isset($this->nspkg->type)){
			if (isset($this->nssearch->value)){
				$value = $this->nssearch->value;
				$type = $this->nspkg->type;
				Zend_Session::namespaceUnset('search');
				Zend_Session::namespaceUnset('nspkg');
				return array($type, $value);
			}
			$this->nssearch->controller = 'mpackage';
			$this->nssearch->action = $this->nspkg->action;
			$this->_forward('index','search');
			return;
		}
		switch($this->nspkg->action){
			case 'addbyjob' :
			case 'delbyjob' :
				$form = new Application_Form_Jobtype();
				break;
			case 'addbyteam':
			case 'delbyteam':
				$form = new Application_Form_Teamtype();
				break;
		}
		$this->view->form = $form;
		$this->render('type');
		return;
	}

}

