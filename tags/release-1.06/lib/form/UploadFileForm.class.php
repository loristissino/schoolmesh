<?php
        class UploadFileForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
			  'file' => new sfWidgetFormInputFile()
            ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'file' => new sfValidatorFile(array('max_size'=>600000))
			));
		}
			
	}