<?php
class ProfileForm extends BaseForm
  {
    public function configure()
    {
			
      $this->setWidgets(array(
        'pronunciation' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'prefers_richtext' => new sfWidgetFormInputCheckbox(),
        'email' => new sfWidgetFormInputText(),
      ));

			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
        'prefers_richtext' => new sfValidatorBoolean(),
			));
			
		}
	}