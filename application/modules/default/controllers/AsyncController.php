<?php

/**
 * Description of AsyncController
 *
 * @author Chanaka
 */
class AsyncController extends Zend_Controller_Action
{

   /*
    * @var Zend_Session_Namespace
    */
    public $_session;

    public function init()
    {
     $this->_helper->viewRenderer->setNoRender();
     $this->_helper->getHelper('layout')->disableLayout();
    }

    public function preDisptch()
    {
        //$this->_session = new Zend_Session_Namespace('default');

        if(!$this->_session->view)
                $this->_session->view = $this->view;

    }
    public function getnoticeAction()
    {
        echo $this->_session->view->notice("hello!");
    }
    
    public function pkginfoAction()
    {      
        if($this->getRequest()->getParam('package'))
        {
            $selpackage = $this->getRequest()->getParam('package');      
            echo Zend_Json_Encoder::encode($this->_findPkg($selpackage));
        }
        else echo "Package name not given";
    }
    
    public function getsecAction()
    {      
        echo Zend_Json_Encoder::encode($this->getSections());
    }
    
    public function getpkgAction()
    {  
        if($this->getRequest()->getParam('section'))
        {
            $selsection = $this->getRequest()->getParam('section');      
            echo Zend_Json_Encoder::encode($this->getPackages($selsection));
        }
        else echo "<div>Section name not found</div>";
      
    }
    
    public function searchpkgAction()
    {  
        if($this->getRequest()->getParam('name'))
        {
            $pkgName = $this->getRequest()->getParam('name');
            echo Zend_Json_Encoder::encode($this->_findPkg($pkgName));
        }
        else echo "Package name not given";
      
    }
    
    
    private function _getSections()
    {      
        $values = array();
        
        $packages = new Application_Model_DbTable_Packages();
        $select = $packages->select()->distinct();
	    $select->from("vos_packages", array('section'));
	    $select->where('component = ?', 'main');
	    $select->order('section');
        //$where = array('component = ?' => 'main');        	  	
        $sections = $packages->fetchAll($select);
        
        foreach ($sections as $section)
        {
          $row = $section->toArray();
          $values[] = $row;   
        }            
            
        return $values;
        
    }
    
    private function _getPackages($selsection)
    {      
        $rowset = array();
        
        $table = new Application_Model_DbTable_Packages();
        $select = $table->select();
	    $select->from("vos_packages", array('package'));
	    $select->where('section = ?', $selsection);
               	  	
        $packages = $table->fetchAll($select);
        
        foreach ($packages as $pacakge)
        {
          $row = $pacakge->toArray();
          $rowset[] = $row;   
        }            
            
        return $rowset;
        
    }
   
    private function _findPkg($pkgName)
    {   
        $table = new Application_Model_DbTable_Packages();
        $select = $table->select();
	$select->from("vos_packages");
	$select->where('package = ?', $pkgName);
               	  	
        $pkgRow = $table->fetchRow($select);            
        $row = $pkgRow->toArray();
        return $row;
    }
    
}