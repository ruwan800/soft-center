<?php

class Form_Feedback extends Zend_Form
{

    public function init()
    {
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title:')
             ->addValidator(new Zend_Validate_Alnum())
             ->setRequired();

        $feedback = new Zend_Form_Element_Textarea('feedback');
        $feedback->setLabel('Your Feedback:')
                ->setRequired()
                ->addValidator(new Zend_Validate_Alnum())
                ->setAttrib('cols', '30')
                ->setAttrib('rows', '10');

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array(
            $title,
            $feedback,
            $submit
        ));
 
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));
                   
    }

}