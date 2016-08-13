<?php

class CreateteamController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
        $createTeamForm = new Application_Form_Createteam();
        if ($createTeamForm->isValid($_POST)) {
        	
        	$request['usr_group_name'] = $createTeamForm->getValue('teamname');
        	$request['usr_group_desc'] = $createTeamForm->getValue('teamdesc');
#        	$request['rqst_log_status'] = $createTeamForm->getValue('teamlead');
#        	$request['rqst_log_status'] = $createTeamForm->getValue('teamtype');
        	$createTeam = new Application_Model_Team($request);
        	$createTeam->createTeam();
        	$this->view->message = "Success";
        }
        else{
        	$this->view->form = $createTeamForm;
        }        
    }

}

