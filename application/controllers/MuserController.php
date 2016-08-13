<?php

class MuserController extends Zend_Controller_Action
{
    public function init()
    {
        $this->model	= new Application_Model_Muser();
      	$this->nssearch	= new Zend_Session_Namespace('search');
      	$this->nsedit	= new Zend_Session_Namespace('edituser');
		$this->form 	= new Application_Form_Adduser();
    }

    public function indexAction()
    {
        // just render view/index.phtml page
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
        	$this->model->addUser($request);
        	$this->view->message = "Team '{}' successfully created.";
		}
		else{
			$this->view->form = $this->form;
    		$this->render('form');
		}

	}

    public function editformAction(){

		$request = $this->getFormValues();
        if ($request) {
        	$this->model->updateUser($request);
			Zend_Session::namespaceUnset('edituser');
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
    	if(!$value){
    		return;
    	}
		$result = $this->model->editUser($value);
		$this->nsedit->values = $result;
		$this->setFormValues($result);
		$this->form->setAction('editform/');
		$this->view->form = $this->form;
		$this->render('form');
    }


    public function delAction()
    {
    	$value = $this->getValue();
		$this->model->deleteUser($value);
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
		$this->nssearch->controller = 'muser';
		$this->nssearch->action = $this->getRequest()->getActionName();
		$this->_forward('index','search');
		return;
	}

	public function getFormValues()
	{
        if ($this->form->isValid($_POST)) {
        	
        	$request['name'] 			= $this->form->getValue('username');
			$request['email'] 			= $this->form->getValue('email');
			$request['priviledge_type'] = $this->form->getValue('privtype');
			$request['job_type'] 		= $this->form->getValue('jobtype');
        	return $request;
		}
		return False; 
	}

	public function setFormValues($request)
	{
		$this->form->username->setvalue($request['name']);
		$this->form->email->setvalue($request['email']);
		$this->form->privtype->setvalue($request['priviledge_type']);
		$this->form->jobtype->setvalue($request['job_type']);
	}


}

