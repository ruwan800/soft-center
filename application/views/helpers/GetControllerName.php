<?php
class Zend_View_Helper_GetControllerName extends Zend_View_Helper_Abstract
{
    public function getControllerName($smart=Null)
    {
    	
    	$smartNames =  array(	'index'			=> 'Home',
    							'error'			=> 'Error',
    							'cat'			=> 'Category',
    							'auth'			=> 'Login',
    							'logout'		=> 'Logout',
    							'pkgsearch'		=> 'Package Search',
    							'pkginstall'	=> 'Package Install',
    							'pkgrequest'	=> 'Package Request',
    							'myteams'		=> 'My Teams',
    							'teamtasks'		=> 'Team Tasks',
    							'addteampkg'	=> 'Add Package for Team',
    							'addteamuser'	=> 'Add User to Team',
    							'delteamuser'	=> 'Delete ',
    							'delteampkg'	=> '',
    							'adduser'		=> '',
    							'deluser'		=> '',
    							'createteam'	=> '',
    							'delteam'		=> '',
    							'softreport'	=> '',
    							'requestlog'	=> '',
    							'acceptrequest'	=> '',
    							'addttpkgs'		=> '',
    							'addutpkgs'		=> '',
    							'delttpkgs'		=> '',
    							'delttpkgs'		=> '',
    							'managepkgs'	=> '' );
    	
		$front = Zend_Controller_Front::getInstance();
		$controller = $front->getRequest()->getControllerName();
		if ($smart && array_key_exists($controller,$smartNames)){
			return $smartNames[$controller];
		}
		return $controller;
    }
}
