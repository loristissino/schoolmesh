<?php

/**
 * Workplan form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWorkplanForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'year_id'        => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'schoolclass_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => false)),
      'subject_id'     => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Workplan', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'year_id'        => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'schoolclass_id' => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id')),
      'subject_id'     => new sfValidatorPropelChoice(array('model' => 'Subject', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Workplan', 'column' => array('user_id', 'year_id', 'schoolclass_id', 'subject_id')))
    );

    $this->widgetSchema->setNameFormat('workplan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Workplan';
  }


}
