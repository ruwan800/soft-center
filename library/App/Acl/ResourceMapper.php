<?php

class App_Acl_ResourceMapper
{
    private $_resources;

    public function preDispatch()
    {
        $this->_resources = new App_Acl_Resources();
    }

    public function findResource($controller, $action)
    {
        
    }

}