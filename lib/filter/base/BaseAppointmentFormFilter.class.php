<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Appointment filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseAppointmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'subject_id'              => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => true)),
      'schoolclass_id'          => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => true)),
      'year_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'state'                   => new sfWidgetFormFilterInput(),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'import_code'             => new sfWidgetFormFilterInput(),
      'wptool_appointment_list' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'subject_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subject', 'column' => 'id')),
      'schoolclass_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolclass', 'column' => 'id')),
      'year_id'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'state'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'import_code'             => new sfValidatorPass(array('required' => false)),
      'wptool_appointment_list' => new sfValidatorPropelChoice(array('model' => 'WptoolItem', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('appointment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addWptoolAppointmentListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(WptoolAppointmentPeer::APPOINTMENT_ID, AppointmentPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Appointment';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'user_id'                 => 'ForeignKey',
      'subject_id'              => 'ForeignKey',
      'schoolclass_id'          => 'ForeignKey',
      'year_id'                 => 'ForeignKey',
      'state'                   => 'Number',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'import_code'             => 'Text',
      'wptool_appointment_list' => 'ManyKey',
    );
  }
}
