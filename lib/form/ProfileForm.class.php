<?php
class ProfileForm extends BaseForm
  {
    public function configure()
    {
      
      $formats=sfConfig::get('app_opendocument_formats');
      $cultures=sfConfig::get('app_config_cultures');
			
      $this->setWidgets(array(
        'pronunciation' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'prefers_richtext' => new sfWidgetFormInputCheckbox(),
        'preferred_format' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $formats))),
        'preferred_culture' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $cultures))),
        'website' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'email' => new sfWidgetFormInputText(array(), array('size'=>30)),
      ));

			$this->widgetSchema->setNameFormat('userinfo[%s]');
      $this['preferred_culture']->getWidget()->setLabel('Interface language');
			
			$this->setValidators(array(
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
        'prefers_richtext' => new sfValidatorBoolean(),
        'preferred_format' => new sfValidatorChoice(array('choices' => array_keys($formats), 'multiple'=>false)),
        'preferred_culture' => new sfValidatorChoice(array('choices' => array_keys($cultures), 'multiple'=>false)),
				'website'  => new sfValidatorUrl(array('protocols'=>array('http','https'), 'trim' => true, 'required' => false, 'max_length'=>255)),
			));
			
		}
	}
