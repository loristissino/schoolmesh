<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Workplan filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWorkplanFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'year_id'        => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'schoolclass_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => true)),
      'subject_id'     => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'year_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'schoolclass_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolclass', 'column' => 'id')),
      'subject_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subject', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('workplan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Workplan';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'user_id'        => 'ForeignKey',
      'year_id'        => 'ForeignKey',
      'schoolclass_id' => 'ForeignKey',
      'subject_id'     => 'ForeignKey',
    );
  }
}
