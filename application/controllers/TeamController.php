<?php

class TeamController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model	= new Application_Model_Team();
      	$this->nssearch	= new Zend_Session_Namespace('search');
      	$this->nsteam	= new Zend_Session_Namespace('team');
    }

    public function indexAction()
    {
        $this->view->result = $this->model->myTeams();
    }

    public function teamAction()
    {
        $this->nsteam->team = $this->_getParam('team', Null);
        // just render view/team.phtml page
    }

    public function adduserAction()
    {
    	$value = $this->getValue();
    	if( ! $value){
    		return;
    	}
		$this->model->addUser($value);
		$this->view->message = "User '{$value}' added to the '{$this->nsteam->team}' team successfully.";
		$this->render('message');
    }

    public function deluserAction()
    {
    	$value = $this->getValue();
    	if( ! $value){
    		return;
    	}
		$this->model->delUser($value);
		$this->view->message = "User '{$value}' removed from the '{$this->nsteam->team}' team.";
		$this->render('message');
    }
    public function addpackageAction()
    {
    	$value = $this->getValue();
    	if( ! $value){
    		return;
    	}
		$this->model->addPackage($value);
		$this->view->message = "Package '{$value}' added to the '{$this->nsteam->team}' team successfully.";
		$this->render('message');
    }
    public function delpackageAction()
    {
    	$value = $this->getValue();
    	if( ! $value){
    		return;
    	}
		$this->model->delPackage($value);
		$this->view->message = "Package '{$value}' removed from the '{$this->nsteam->team}'team .";
		$this->render('message');
    }

	public function getValue()
	{
		if (isset($this->nssearch->value)){
			$value = $this->nssearch->value;
			Zend_Session::namespaceUnset('search');
			return $value;
		}
		$this->nssearch->controller = 'team';
		$this->nssearch->action = $this->getRequest()->getActionName();
		$this->_forward('index','search');
	}
}

