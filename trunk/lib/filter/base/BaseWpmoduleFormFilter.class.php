<?php

/**
 * Wpmodule filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWpmoduleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'         => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'           => new sfWidgetFormFilterInput(),
      'period'          => new sfWidgetFormFilterInput(),
      'hours_estimated' => new sfWidgetFormFilterInput(),
      'hours_used'      => new sfWidgetFormFilterInput(),
      'appointment_id'  => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'rank'            => new sfWidgetFormFilterInput(),
      'is_public'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'user_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'           => new sfValidatorPass(array('required' => false)),
      'period'          => new sfValidatorPass(array('required' => false)),
      'hours_estimated' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hours_used'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'appointment_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Appointment', 'column' => 'id')),
      'rank'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_public'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('wpmodule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpmodule';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'user_id'         => 'ForeignKey',
      'title'           => 'Text',
      'period'          => 'Text',
      'hours_estimated' => 'Number',
      'hours_used'      => 'Number',
      'appointment_id'  => 'ForeignKey',
      'rank'            => 'Number',
      'is_public'       => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
