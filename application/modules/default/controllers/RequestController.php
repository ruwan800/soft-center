<?php

class RequestController extends Zend_Controller_Action
{
    /**
     *
     * @var Zend_Mail Object 
     */
    protected $_mail;


    public function init()            
    {

    }

    public function indexAction()
    {
       $this->view->form = new Form_Request();       
    }


}

