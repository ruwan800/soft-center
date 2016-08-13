<?php

class SoftreportController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $cwd = getcwd();
        $result = scandir($cwd."/upt/");
        unset($result[0]);
        unset($result[1]);
        $this->view->result = $result;
    }


}

