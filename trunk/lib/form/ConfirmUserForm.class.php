<?php
        class ConfirmUserForm extends sfForm
        {
          public function configure()
          {
            $this->setWidgets(array(
			  'username' =>  new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
			  'account' =>  new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
           ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorString(array('trim' => true)), 
				'account' => new sfValidatorString(array('trim' => true)), 
			));
			
			}

	}