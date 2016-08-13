<?php

class AdduserController extends Zend_Controller_Action
{

    public function init()
    {

        $this->AddUserForm = new Application_Form_Adduser();
        
    }

    public function formAction()
    {
        if ($this->AddUserForm->isValid($_POST)) {

			$request['name'] = $this->AddUserForm->getValue('username');
			$request['email'] = $this->AddUserForm->getValue('email');
			$request['priviledge_type'] = $this->AddUserForm->getValue('privtype');
			$request['job_type'] = $this->AddUserForm->getValue('jobtype');
			$AddUser = new Application_Model_Adduser();
			$AddUser->AddUser($request);
			$this->view->message = "User added successfully.";
        }        
    }

	public function indexAction(){
	
        $this->view->form = $this->AddUserForm;
	
	}

}

