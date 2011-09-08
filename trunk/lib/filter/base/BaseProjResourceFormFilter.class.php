<?php

/**
 * ProjResource filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjResourceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id'      => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_resource_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjResourceType', 'add_empty' => true)),
      'description'           => new sfWidgetFormFilterInput(),
      'charged_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'quantity_estimated'    => new sfWidgetFormFilterInput(),
      'quantity_approved'     => new sfWidgetFormFilterInput(),
      'quantity_final'        => new sfWidgetFormFilterInput(),
      'standard_cost'         => new sfWidgetFormFilterInput(),
      'scheduled_deadline'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'schoolproject_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'proj_resource_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjResourceType', 'column' => 'id')),
      'description'           => new sfValidatorPass(array('required' => false)),
      'charged_user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'quantity_estimated'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity_approved'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity_final'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'standard_cost'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'scheduled_deadline'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('proj_resource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResource';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'schoolproject_id'      => 'ForeignKey',
      'proj_resource_type_id' => 'ForeignKey',
      'description'           => 'Text',
      'charged_user_id'       => 'ForeignKey',
      'quantity_estimated'    => 'Number',
      'quantity_approved'     => 'Number',
      'quantity_final'        => 'Number',
      'standard_cost'         => 'Number',
      'scheduled_deadline'    => 'Date',
    );
  }
}
