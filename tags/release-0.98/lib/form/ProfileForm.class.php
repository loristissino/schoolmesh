<?php
class ProfileForm extends BaseForm
  {
    public function configure()
    {
      
      $formats=sfConfig::get('app_opendocument_formats');
			
      $this->setWidgets(array(
        'pronunciation' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'prefers_richtext' => new sfWidgetFormInputCheckbox(),
        'preferred_format' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $formats))),
        'email' => new sfWidgetFormInputText(),
      ));

			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
        'prefers_richtext' => new sfValidatorBoolean(),
        'preferred_format' => new sfValidatorChoice(array('choices' => array_keys($formats), 'multiple'=>false)),
			));
			
		}
	}
