<?php
        class EditWpRejectForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'comment' => new sfWidgetFormInputText(array(), array('size'=>100)),
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'comment' => new sfValidatorString(array('trim' => true, 'required' => true, 'max_length'=>255)),
			));
			
			}

	}