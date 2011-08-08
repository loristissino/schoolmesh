<?php

/**
 * Team filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTeamFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'        => new sfWidgetFormFilterInput(),
      'posix_name'         => new sfWidgetFormFilterInput(),
      'quality_code'       => new sfWidgetFormFilterInput(),
      'needs_folder'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'needs_mailing_list' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'        => new sfValidatorPass(array('required' => false)),
      'posix_name'         => new sfValidatorPass(array('required' => false)),
      'quality_code'       => new sfValidatorPass(array('required' => false)),
      'needs_folder'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'needs_mailing_list' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'description'        => 'Text',
      'posix_name'         => 'Text',
      'quality_code'       => 'Text',
      'needs_folder'       => 'Boolean',
      'needs_mailing_list' => 'Boolean',
    );
  }
}
