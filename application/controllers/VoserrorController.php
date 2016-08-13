<?php

class VoserrorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $errors = $this->_getParam('error_handler');
        $this->view->error = $errors;
    }

    public function baduserAction()
    {
    }


}

