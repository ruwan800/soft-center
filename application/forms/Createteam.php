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
				 ->setAttrib('rows=10 cols=45', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'));

		$teamdesc->class = "text";        
		$teamdesc->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$teamlead = new Zend_Form_Element_Text('teamowner');
		$teamlead->setLabel('Team Owner:')
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
		
		
		$teamtype = new Zend_Form_Element_Select('teamtype');
		$teamtype->setLabel('Type of team :')
				->addMultiOption('designing', 'Designing')
				->addMultiOption('testing', 'Testing')
				->addMultiOption('management', 'Management')
				->addMultiOption('marketing', 'Marketing');

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
				$teamlead,
				#$usertype,
				$teamtype,
				$teamdesc,
				$submit
			));

		$this->addElement('image', 'createteam', array(
				'description' => '<a href="" class="button yellow form_submit"><small class="icon plus"></small><span>Save Team Details</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));

    }


}

