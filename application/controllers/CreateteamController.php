<?php

class CreateteamController extends Zend_Controller_Action
{

    public function init()
    {
        $this->form 	= new Application_Form_Createteam();
        $this->model	= new Application_Model_Team();
    }

    public function formAction(){
     
        if ($this->form->isValid($_POST)) {
        	
        	$request['team_name']	= $this->form->getValue('teamname');
        	$request['team_descreption']	= $this->form->getValue('teamdesc');
        	$request['team_owner']	= $this->form->getValue('teamowner');
        	$request['team_type']	= $this->form->getValue('teamtype');
        	$this->model->createTeam($request);
        	$this->view->message = "Team '{$request['team_name']}' successfully created.";
		}
		else{
			$this->view->form = $this->form;
    		$this->render('index');
		}

	}

	public function indexAction(){
	
		$this->view->form = $this->form;
	
	}

}

