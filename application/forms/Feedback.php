<?php

class Form_Feedback extends Zend_Form
{

    public function init()
    {   
        $feedback = new Zend_Form_Element_Textarea('feedback');
        $feedback->setLabel('Your Feedback');
        
        $submit = new Zend_Form_Element_Submit('submit');
        
        $this->addElements(array(
            $feedback,
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

