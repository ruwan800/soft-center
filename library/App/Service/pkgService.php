<?php


/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Service_pkgService
{
    /**
     * @var Application_Model_DbTable_Packages
     */
    protected $_pkgsTable;    

    /**
     * @var Zend_Db
     */
    //protected $_db;
    
    public function __construct() 
    {
       $this->_pkgsTable = new Model_DbTable_Packages();
    }
    
    /**
     * retrieve a rowset of all distinct sections
     * 
     * @return Zend_Db_Table_Rowset
     */
    public function getSectsInComponent($selcomponent)
    {        
        $select = $this->_pkgsTable->select()->distinct();
	$select->from("vos_packages", array('section','component'));
	$select->where('component = ?', $selcomponent);
        $select->order('section');
        
        $adapter = new Zend_Paginator_Adapter_DbSelect($select);        
        
        return $adapter;       
    }
    
    /**
     * Retrieve all rows under selected section
     * 
     * @param String
     * @return Zend_Db_Table_Rowset
     */
    public function getPkgsInSection($selsection)
    {
        $select = $this->_pkgsTable->select();
	$select->from("vos_packages", array('package','filename','repository'));
	$select->where('section = ?', $selsection);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        return $adapter;
    }        
    
    /**
     * retrieve the row of the selected package
     * 
     * @param String
     * @return Zend_Db_Table_row
     */
    public function getPkg($selpackage)
    {
        // set selected package        
        $where = $this->_pkgsTable->getAdapter()->quoteInto('package = ?', $selpackage);
        
        // retrieve the row corresponding to the selected package  	
        return $this->_pkgsTable->fetchRow($where);
    }
    /**
     * retrieve the row of the selected package
     *
     * @param String
     * @return Zend_Db_Table_rowset
     */
    public function getAllPkgs()
    {
        $select = $this->_pkgsTable->select();
	$select->from("vos_packages", array('package','filename','repository'));	

        $rowset = $this->_pkgsTable->fetchAll($select);

        return $rowset;
    }
        
    
    
}


