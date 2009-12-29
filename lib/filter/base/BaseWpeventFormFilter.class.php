<?php

/**
 * Wpevent filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWpeventFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'comment'        => new sfWidgetFormFilterInput(),
      'state'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'appointment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Appointment', 'column' => 'id')),
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'comment'        => new sfValidatorPass(array('required' => false)),
      'state'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wpevent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpevent';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'created_at'     => 'Date',
      'appointment_id' => 'ForeignKey',
      'user_id'        => 'ForeignKey',
      'comment'        => 'Text',
      'state'          => 'Number',
    );
  }
}
