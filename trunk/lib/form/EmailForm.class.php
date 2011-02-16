<?php

class EmailForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'email_subject' => new sfWidgetFormInputText(array(), array('size'=>70)),
      'body'          => new sfWidgetFormTextarea(array(), array('cols'=>70, 'rows'=>30)),
    ));
    
    $this->widgetSchema->setNameFormat('email[%s]');

    $this->setValidators(array(
      'email_subject' => new sfValidatorString(array('required'=>true)),
      'body'          => new sfValidatorString(array('required'=>true))
    ));
  }
}