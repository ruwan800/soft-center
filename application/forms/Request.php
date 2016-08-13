<?php

class Form_Request extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $manager = new Zend_Form_Element_Text('manager');
        $manager->setLabel('Reporting Manager\'s Name *')
                ->addValidator(new Zend_Validate_Alnum())
                ->setRequired();
        
        $pkgName = new Zend_Form_Element_Text('pkgName');
        $pkgName->setLabel('Package Name *')
                ->addValidator(new Zend_Validate_Alnum())
                ->setRequired('true');
        
        $comments = new Zend_Form_Element_Textarea('comments');
        $comments->setLabel('Additional Comments (Optional)')
                ->addValidator(new Zend_Validate_Alnum())
                ->setAttrib('cols', '30')
                ->setAttrib('rows', '5');
        
        $submit = new Zend_Form_Element_Submit('submit');   

        
        $this->addElements(array(
            $pkgName,
            $manager,      
            $comments,            
            $submit
        ));        
        
        $this->setElementDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),  array('tag' =>'td', 'class'=> 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div'))
        ));

        $submit->setDecorators(array('ViewHelper',
            array(array('data' => 'HtmlTag'),  array('tag' =>'td', 'class'=> 'element')),
            array(array('emptyrow' => 'HtmlTag'),  array('tag' =>'td', 'class'=> 'element', 'placement' => 'PREPEND')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div'))
            ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));                   
    }


}

