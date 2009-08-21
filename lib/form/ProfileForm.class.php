<?php
        class ProfileForm extends sfForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
              'pronunciation' => new sfWidgetFormInput(array(), array('size'=>70)),
			  'email' => new sfWidgetFormInput(),
            ));

			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
			));
			
		}
	}