<?php

/**
 * Appointment filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseAppointmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'subject_id'              => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => true)),
      'schoolclass_id'          => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => true)),
      'team_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'year_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'state'                   => new sfWidgetFormFilterInput(),
      'hours'                   => new sfWidgetFormFilterInput(),
      'is_public'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'syllabus_id'             => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'import_code'             => new sfWidgetFormFilterInput(),
      'wptool_appointment_list' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'subject_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subject', 'column' => 'id')),
      'schoolclass_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolclass', 'column' => 'id')),
      'team_id'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Team', 'column' => 'id')),
      'year_id'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'state'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hours'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_public'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'syllabus_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Syllabus', 'column' => 'id')),
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
      'team_id'                 => 'ForeignKey',
      'year_id'                 => 'ForeignKey',
      'state'                   => 'Number',
      'hours'                   => 'Number',
      'is_public'               => 'Boolean',
      'syllabus_id'             => 'ForeignKey',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'import_code'             => 'Text',
      'wptool_appointment_list' => 'ManyKey',
    );
  }
}
