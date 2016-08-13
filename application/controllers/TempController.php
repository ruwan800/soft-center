<?php

class TempController extends Zend_Controller_Action
{

    public function init()
    {
		$this->temp	 = new Zend_Session_Namespace('help');
		if(! isset($this->temp->count)){
		    	$this->temp->count = 1;
		}
		else{	
		    	$this->temp->count ++;
		}
		echo "EEEEEEEEEEEEE".$this->temp->count."WWWWWWWWWW";########################
    }

    public function indexAction()
    {
        // action body
    }


}

