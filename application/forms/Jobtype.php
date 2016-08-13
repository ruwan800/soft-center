<?php

class Application_Form_Jobtype extends Zend_Form
{

    public function init()
    {
		$jobtype = new Zend_Form_Element_Select('type');
		$jobtype->setLabel('Type of Job :')
				->addMultiOption('designing', 'Designing')
				->addMultiOption('testing', 'Testing')
				->addMultiOption('management', 'Management')
				->addMultiOption('marketing', 'Marketing');

		$jobtype->class = "text";        
		$jobtype->setDecorators(array(
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
				$jobtype,
				$submit
			));

		$this->addElement('image', 'createteam', array(
				'description' => '<a href="" class="button yellow form_submit"><small class="icon plus"></small><span>Continue</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));
    }


}

