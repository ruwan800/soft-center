<?php

class AdduserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $AddUserForm = new Application_Form_Adduser();
        if ($AddUserForm->isValid($_POST)) {

        	$request['usr_group_name'] = $AddUserForm->getValue('username');
        	$request['usr_group_desc'] = $AddUserForm->getValue('email');
        	$request['rqst_log_status'] = $AddUserForm->getValue('usertype');
#        	$request['rqst_log_status'] = $AddUserForm->getValue('teamtype');
        	$AddUser = new Application_Model_Adduser($request);
        	$AddUser->AddUser();
        	$this->view->message = "Success";
        }
        else{
        	$this->view->form = $AddUserForm;
        }        
    }


}

