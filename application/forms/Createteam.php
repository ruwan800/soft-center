<?php

class Application_Form_Createteam extends Zend_Form
{

    public function init()
    {
        
		$this->setName("Crateteam")
			 ->setMethod('post');

		$teamname = new Zend_Form_Element_Text('teamname');
		$teamname->setLabel('Team Name:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 10));

		$teamname->class = "text";        
		$teamname->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$teamdesc = new Zend_Form_Element_Textarea('teamdesc');
		$teamdesc->setLabel('Team Description:')
				 ->setRequired()
				 ->setAttrib('rows=15 cols=45', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 70));

		$teamdesc->class = "text";        
		$teamdesc->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$teamlead = new Zend_Form_Element_Text('teamlead');
		$teamlead->setLabel('Team Leader:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(0, 70));

		$teamlead->class = "text";        
		$teamlead->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$usertype = new Zend_Form_Element_Select('usertype');
		$usertype->setLabel('Priviledges of user :')
				->addMultiOption('level1','level1' )
				->addMultiOption('level2','level2')
				->addMultiOption('level3','level3' )
				->addMultiOption('admin','Administrater');
		$usertype->class = "text";        
		$usertype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
		
		
		$teamtype = new Zend_Form_Element_Select('type');
		$teamtype->setLabel('Type of team :')
				->addMultiOption('Designing', 'designing')
				->addMultiOption('Testing', 'testing')
				->addMultiOption('Management', 'Management')
				->addMultiOption('Marketing', 'marketing');

		$teamtype->class = "text";        
		$teamtype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
		
		    	
		$submit = new Zend_Form_Element_Submit('createteam');
		$submit->class = "novisible";
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('HtmlTag', array('tag' => 'p'))
		));

		$this->addElements(array(
				$teamname,
				$teamdesc,
				$teamlead,
				$usertype,
				$teamtype,
				$submit
			));

		$this->addElement('image', 'createteam', array(
				'description' => '<a href="" class="button yellow form_submit"><small class="icon plus"></small><span>Create Team</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));

    }


}

