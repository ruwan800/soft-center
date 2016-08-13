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
		$this->setParam();
	}

	public function delbyjobAction()
	{
		$this->setParam();
	}

	public function addbyteamAction()
	{
		$this->setParam();
	}

	public function delbyteamAction()
	{
		$this->setParam();
	}

	public function packageAction()
	{
		$action	= $this->nspkg->action;
		$type	= $this->nspkg->type;
		$value	= $this->nssearch->value;
		Zend_Session::namespaceUnset('search');
		Zend_Session::namespaceUnset('mpackage');
		switch($action){
			case 'addbyjob' :
				$this->model->addByJobType($type,$value);
				$this->view->message = "Package '{$value}' added to the '{$type}' job category successfully.";
				break;
			case 'delbyjob' :
				$this->model->delByJobType($type,$value);
				$this->view->message = "Package '{$type}' deleted from '{$value}' job category.";
				break;
			case 'addbyteam':
				$this->model->addByTeamType($type,$value);
				$this->view->message = "Package '{$type}' added to the '{$value}' team type successfully.";
				break;
			case 'delbyteam':
				$this->model->delByTeamType($type,$value);
				$this->view->message = "User '{$type}' deleted from '{$value}' team  type.";
				break;
		}
		$this->render('message');
	}


	public function formAction()
	{
		$form = $this->getForm();
    	if ($form->isValid($_POST)){
    		$type = $form->getValue('type',Null);
    		if($type){
    			$this->nspkg->type = $type;
    		}
    		$this->search();
    	}
    	else{
			$this->selectType();
    	}
	}

	public function errorAction()
	{
		
	}

	public function getForm()
	{
		switch($this->nspkg->action){
			case 'addbyjob' :
			case 'delbyjob' :
				return new Application_Form_Jobtype();
				break;
			case 'addbyteam':
			case 'delbyteam':
				return new Application_Form_Teamtype();
				break;
		}
	}

	public function selectType()
	{
		$form = $this->getForm();
		$form->setAction("form/");
		$this->view->form = $form;
		$this->render('type');
	}

	public function setParam()
	{
		$this->nspkg->action = $this->getRequest()->getActionName();
		$this->selectType();
	}

	public function search()
	{
		$this->nssearch->controller = 'mpackage';
		$this->nssearch->action = 'package';
		$this->_forward('index','search');
	}

}

