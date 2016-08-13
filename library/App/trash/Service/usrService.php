<?php

/**
 * Description of usrService
 *
 * @author CS
 */
class App_Service_usrService
{
    /*
     * @var Model_DbTable_Users
     */
    protected $_usrTable;
    /*
     * @var Model_DbTable_Privileges
     */
    protected $_privTable;
    
    public function  __construct()
    {
        $this->_usrTable = new Model_DbTable_Users();
        $this->_privTable = new Model_DbTable_Privileges();
    }
    
    public function createUser($username, $password)
    {
        if (strlen($username) > 0 && strlen($password) > 0)
        {
            $configs = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
            $salt = $configs->auth['salt'];

            $pwdHashed = SHA1($pwdHashed.$salt);

            $reult = $this->_usrTable->insert(array(NULL,$username,$pwdHashed));

            if ($result)
            {
                return $result;
            }
            else return -1;
        }
    }

    /*
     * Returns corresponding row from UsersTable
     *
     * @throw Zend_Db_Table_Exception
     * @return Zend_Db_Table_Rowset
     */
    public function getUserByName($username)
    {
        if (strlen($username) > 0)
        {
            $select = $this->_usrTable->select();
            $where = $select->where('username = ?', $username);

            $result = $this->_usrTable->fetchRow($where);

            if ($result)
            {
                return $result;
            }
            else throw new Zend_Db_Table_Exception('username does not exist.');
        }        
    }

    /*
     * Returns all rows from UsersTable
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAllUsers()
    {
        return $this->_usrTable->fetchAll();
    }

    public function addUserPriv($pkgName, $username)
    {        
        if(!empty($pkgName) && !empty($username))
        {
            $userRow = $this->getUserByName($username);

            $params = array(
                'package' => $pkgName,
                'username' => $username
            );
            $result = $this->_privTable->insert($params);

            if ($result)
            {
                return $result;
            }
            else return -1;
        }
    }
    
}

