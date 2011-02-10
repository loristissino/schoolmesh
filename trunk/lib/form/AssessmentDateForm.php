<?php

/**
 * Account form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class AssessmentDateForm extends BaseForm
{
  public function configure()
  {
  
	$this->setWidgets(array(
  	'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
	  'assessment_date'  => new sfWidgetFormI18nDate(array('culture'=>'it')),
	));

	$this->widgetSchema->setNameFormat('accountinfo[%s]');
	
	$this->setValidators(array(
  	'id' => new sfValidatorInteger(),
		'assessment_date' => new sfValidatorDate(array('required'=>false)),
	));
  
	}
}
