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
     * @var Application_Model_DbTable_Sections
     */
    protected $_sectsTable;

    /**
     * @var Zend_Db
     */
    //protected $_db;
    
    public function __construct() 
    {
       $this->_pkgsTable = new Model_DbTable_Packages();
       $this->_sectsTable = new Model_DbTable_Sections();
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
        
        return $this->_pkgsTable->fetchAll($select);
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

        return $this->_pkgsTable->fetchAll($select);
    }        

    /**
     * Retrieve all rows under selected section
     *
     * @param String
     * @return Zend_Db_Table_Rowset
     */
    public function getPkgsInCategory($category)
    {
        $select = $this->_pkgsTable->select();
	$select->from("vos_packages", array('package','filename','repository','description'));
	$select->where('tag = ?', $category);

        return $this->_pkgsTable->fetchAll($select);
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
     * retrieve all row from Packages Table
     * 
     * @return Zend_Db_Table_Rowset
     */
    public function getAllPkgs()
    {
        return $this->_pkgsTable->fetchAll();
    }

    /**
     * retrieve all row from Sections Table
     * 
     * @return Zend_Paginator_Adapter_DbSelect
     */
    public function getAllSections()
    {
        $select = $this->_sectsTable->select();
	$select->from("vos_sections")
                ->order('name');

        return $this->_pkgsTable->fetchAll($select);
    }

    public function ftSearch($searchTerm)
    {
        $sql = "SELECT package,description FROM vos_packages WHERE package LIKE '%{$searchTerm}%' LIMIT 0,1000";
        $db = Zend_Db_Table::getDefaultAdapter();
        return $db->fetchAll($sql);
    }
        
    
    
}


