<?php
        class ConfirmUserForm extends BaseForm
        {
          public function configure()
          {
            $this->setWidgets(array(
			  'username' =>  new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
			  'account' =>  new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
           ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorString(array('trim' => true)), 
				'account' => new sfValidatorString(array('trim' => true)), 
			));
			
			}

	}