<?php
    class ProjectForm extends BaseForm
	{
		
		public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
		{   
			parent::__construct($defaults, $options, $CSRFSecret);
			/*
			if($defaults['deadlines_count']>0)
			{
				$this->embedFormForEach('deadlines', new DeadlineForm(), $defaults['deadlines_count']);
			}*/
	 
		}
		
          public function configure()
          {
			
            $this->setWidgets(array(
			  'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
              'title'    => new sfWidgetFormInputText(array(), array('size'=>50)),
			  'coordinator'  => new sfWidgetFormPropelSelect(array('model'=>'sfGuardUserProfile', 'peer_method'=>'retrieveAllButStudents', 'add_empty'=>'Choose a user')),
            ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'id' => new sfValidatorInteger(),
				'title' => new sfValidatorString(array('trim' => true)),
				'coordinator' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),  

			));
			
			
			}

	}