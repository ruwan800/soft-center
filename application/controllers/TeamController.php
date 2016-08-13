<?php

class TeamController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model	= new Application_Model_Team();
    }

    public function indexAction() {

        $this->view->result = $this->model->myTeams();
    }

    public function teamAction() {

        // just render view/team.phtml page
    }

    public function adduserAction() {

		$this->_forward('index','addteamuser');
    }

    public function deluserAction() {

		$this->_forward('index','delteamuser');
    }
    public function addpackageAction() {

		$this->_forward('index','addteampkg');
    }

    public function delpackageAction() {

		$this->_forward('index','delteampkg');
    }

}

