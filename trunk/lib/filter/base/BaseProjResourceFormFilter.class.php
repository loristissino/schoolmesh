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
      'schoolproject_id'         => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_resource_type_id'    => new sfWidgetFormPropelChoice(array('model' => 'ProjResourceType', 'add_empty' => true)),
      'description'              => new sfWidgetFormFilterInput(),
      'charged_user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'quantity_estimated'       => new sfWidgetFormFilterInput(),
      'quantity_approved'        => new sfWidgetFormFilterInput(),
      'amount_estimated'         => new sfWidgetFormFilterInput(),
      'amount_funded_externally' => new sfWidgetFormFilterInput(),
      'financing_notes'          => new sfWidgetFormFilterInput(),
      'quantity_final'           => new sfWidgetFormFilterInput(),
      'standard_cost'            => new sfWidgetFormFilterInput(),
      'is_monetary'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'scheduled_deadline'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'schoolproject_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'proj_resource_type_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjResourceType', 'column' => 'id')),
      'description'              => new sfValidatorPass(array('required' => false)),
      'charged_user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'quantity_estimated'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity_approved'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount_estimated'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount_funded_externally' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'financing_notes'          => new sfValidatorPass(array('required' => false)),
      'quantity_final'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'standard_cost'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_monetary'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'scheduled_deadline'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'id'                       => 'Number',
      'schoolproject_id'         => 'ForeignKey',
      'proj_resource_type_id'    => 'ForeignKey',
      'description'              => 'Text',
      'charged_user_id'          => 'ForeignKey',
      'quantity_estimated'       => 'Number',
      'quantity_approved'        => 'Number',
      'amount_estimated'         => 'Number',
      'amount_funded_externally' => 'Number',
      'financing_notes'          => 'Text',
      'quantity_final'           => 'Number',
      'standard_cost'            => 'Number',
      'is_monetary'              => 'Boolean',
      'scheduled_deadline'       => 'Date',
    );
  }
}
