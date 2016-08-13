<?php

class Application_Form_Adduser extends Zend_Form
{

    public function init()
    {
       
		$this->setName("add-user")
			 ->setAction('/adduser/form/')
			 ->setMethod('post');

		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('User Name:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 10));

		$username->class = "text";        
		$username->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('User e-mail:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 70));

		$email->class = "text";        
		$email->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));



		$privtype = new Zend_Form_Element_Select('privtype');
		$privtype->setLabel('Priviledges of user :')
				->addMultiOption('default','Restricted User')
				->addMultiOption('admin','Administrator');
		$privtype->class = "text";        
		$privtype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
		
		
		$jobtype = new Zend_Form_Element_Select('jobtype');
		$jobtype->setLabel('Jobtype of user :')
				->addMultiOption('programer','programer' )
				->addMultiOption('qa','qa')
				->addMultiOption('Manager','Manager' )
				->addMultiOption('admin','Administrater');
		$jobtype->class = "text";        
		$jobtype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));

		$submit = new Zend_Form_Element_Submit('Add User');
		$submit->class = "novisible";
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('HtmlTag', array('tag' => 'p'))
		));

		$this->addElements(array(
				$username,
				$email,
				$privtype,
				$jobtype,
				$submit
			));

		$this->addElement('image', 'createteam', array(
				'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Add User</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));

    }


}

