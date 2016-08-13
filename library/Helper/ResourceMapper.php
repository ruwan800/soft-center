<?php
echo "PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP";
class Helper_ResourceMapper
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
