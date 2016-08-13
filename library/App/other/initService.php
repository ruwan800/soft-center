<?php

/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_initService 
{
    /**
     * @var Application_Model_DbTable_Packages     
     */
    protected $_packages;    
    
    public function __construct() 
    {
       $this->_packages = new Application_Model_DbTable_Packages();       
    }
    
    /**
     *  update vos_packages table to associate
     *  details about sections
     * 
     */
    public function getAllSections()
    {
        
        $config = new Zend_Config_Ini(APPLICATION_PATH. '/configs/defaultSects.ini' , 'sections');
        
        $select = $this->_packages->select()->distinct();
	    $select->from("vos_packages", array('section','component'));
        $select->order('section');
        
        // Database Access call
        // retrieve a rowset of all distinct sections
        $Rowset = $this->_packages->fetchAll($select);
        
        // To store rowsets based on different components
        // arrays of objects (table rows)
        $main = array();
        $multiverse = array();
        $universe = array();
        $restricted = array();
        
        // seperate into components
        foreach ($Rowset as $row) 
        {
                if ($row->component=="multiverse") {
                    // get section name 
                    // check it against vos_sections table
                    // if there's a match                                          
                    $multiverse[] = $row;
                }
                else if ($row->component=="universe") {
                    $universe[] = $row;
                }
                else if ($row->component=="restricted") {
                    $restricted[] = $row;
                }
                else
                    $pattern = "/admin/";
                    if (preg_match($pattern, $row->section, $matches))                        
                        $row->section = $config->sect->admin->name;
                    $main[] = $row;                
        }        
    }
    
            
}