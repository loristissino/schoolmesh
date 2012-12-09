<?php
        class MakeDirForm extends BaseForm
        {
          public function configure()
          {
            $this->setWidgets(array(
			  'directory' => new sfWidgetFormInputText()
            ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'directory' => new sfValidatorString(array('min_length'=>1))
			));
		}
			
	}