<?php
        class EditWpmoduleHeadingForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
			    'title' => new sfWidgetFormInputText(array(), array('size'=>70)),
			    'period' => new sfWidgetFormInputText(array(), array('size'=>30)),
			    'hours_estimated' => new sfWidgetFormInputText(array(), array('size'=>5)),
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'title'   => new sfValidatorString(array('trim' => true, 'required'=>true)),
				'period'   => new sfValidatorString(array('trim' => true, 'required'=>true)),
				'hours_estimated'   => new sfValidatorInteger(array('trim' => true, 'required'=>false, 'min'=>0, 'max'=>500)),
			));
			
			}

	}