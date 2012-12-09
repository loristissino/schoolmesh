<?php

  class ProjectDateForm extends BaseForm
  {
    public function configure()
    {
      $this->setWidgets(array(
			  'date' => new sfWidgetFormI18nDate(array('culture'=>'it')),
			  'notes'  => new sfWidgetFormTextarea(),
        ));
			
			$this->widgetSchema->setNameFormat('projectinfo[%s]');
			
			$this->setValidators(array(
				'date' => new sfValidatorDate(array('required'=>true, 'max'=>time())),
				'notes' => new sfValidatorString(array('trim' => true, 'required'=>false)),
			));
			
    }
    
    public function setLabels($labels=array())
    {
      foreach($labels as $label=>$value)
      {
        $this[$label]->getWidget()->setLabel($value);
      }
    }

	}
