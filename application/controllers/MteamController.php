<?php

class MteamController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model	= new Application_Model_Mteam();
      	$this->nssearch	= new Zend_Session_Namespace('search');
      	$this->nsedit	= new Zend_Session_Namespace('editteam');
		$this->form 	= new Application_Form_Createteam();
    }

    public function addAction()
    {
		$this->view->form = $this->form;
		$this->form->setAction('form/');
		$this->render('form');
    }

    public function formAction(){

		$request = $this->getFormValues();
        if ($request) {
        	$this->model->createTeam($request);
        	$this->view->message = "Team '{$request['team_name']}' successfully created.";
		}
		else{
			$this->view->form = $this->form;
    		$this->render('form');
		}

	}

    public function editformAction(){

		$request = $this->getFormValues();
        if ($request) {
        	$this->model->updateTeam($request);
			Zend_Session::namespaceUnset('editteam');
        	$this->view->message = "Team '{$request['team_name']}' successfully created.";
		}
		else{
			$this->form->setAction('editform/');
			$this->setFormValues($this->nsedit->values);
			$this->view->form = $this->form;
    		$this->render('form');
		}

	}


    public function editAction()
    {
    	$value = $this->getValue();
		$result = $this->model->editTeam($value);
		$this->nsedit->values = $result;
		$this->setFormValues($result);
		$this->form->setAction('editform/');
		$this->view->form = $this->form;
		$this->render('form');
		$this->view->message = "User '{$value}' added to the '{$this->nsteam->team}' team successfully.";
		$this->render('message');
    }


    public function delAction()
    {
    	$value = $this->getValue();
		$this->model->deleteTeam($value);
		$this->view->message = "User '{$value}' added to the '{$this->nsteam->team}' team successfully.";
		$this->render('message');
    }

	public function getValue()
	{
		if (isset($this->nssearch->value)){
			$value = $this->nssearch->value;
			Zend_Session::namespaceUnset('search');
			return $value;
		}
		$this->nssearch->controller = 'mteam';
		$this->nssearch->action = $this->getRequest()->getActionName();
		$this->_forward('index','search');
	}

	public function getFormValues()
	{
        if ($this->form->isValid($_POST)) {
        	
        	$request['team_name']			= $this->form->getValue('teamname');
        	$request['team_description']	= $this->form->getValue('teamdesc');
        	$request['team_owner']			= $this->form->getValue('teamowner');
        	$request['team_type']			= $this->form->getValue('teamtype');
        	return $request;
		}
		return False; 
	}

	public function setFormValues($request)
	{
		$this->form	->teamname->setvalue($request['team_name'])
					->teamowner->setvalue($request['team_owner'])
					->teamtype->setvalue($request['team_type'])
					->teamdesc->setvalue($request['team_description']);
	}

}

