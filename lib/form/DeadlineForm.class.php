<?php
    class DeadlineForm extends BaseForm
	{
		
/*		public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
		{   
			parent::__construct($defaults, $options, $CSRFSecret);
	 
			ob_start();
			echo "Building the form...\n";
			print_r($defaults);

			$f=fopen('lorislog.txt', 'a'); fwrite($f, ob_get_contents());fclose($f);ob_end_clean();

	}
*/
		
          public function configure()
          {
			
            $this->setWidgets(array(
			  'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
			  'project_id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
              'description'    => new sfWidgetFormInputText(array(), array('size'=>50)),
			  'user'  => new sfWidgetFormPropelSelect(array('model'=>'sfGuardUserProfile', 'peer_method'=>'retrieveAllButStudents', 'add_empty'=>'Choose a user')),
            ));

//			$this->widgetSchema->setNameFormat('%s');
			
			$this->setValidators(array(
				'id' => new sfValidatorInteger(),
				'project_id' => new sfValidatorInteger(),
				'description' => new sfValidatorString(array('trim' => true)),
				'user' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),  

			));
			
//             $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
             // see http://blog.barros.ws/2008/12/01/using-embedformforeach-in-symfon/
			
			
			}

	}