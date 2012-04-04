<?php

/**
 * WptoolItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWptoolItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'             => new sfWidgetFormFilterInput(),
      'rank'                    => new sfWidgetFormFilterInput(),
      'code'                    => new sfWidgetFormFilterInput(),
      'wptool_item_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'WptoolItemType', 'add_empty' => true)),
      'wptool_appointment_list' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'description'             => new sfValidatorPass(array('required' => false)),
      'rank'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code'                    => new sfValidatorPass(array('required' => false)),
      'wptool_item_type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WptoolItemType', 'column' => 'id')),
      'wptool_appointment_list' => new sfValidatorPropelChoice(array('model' => 'Appointment', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wptool_item_filters[%s]');

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

    $criteria->addJoin(WptoolAppointmentPeer::WPTOOL_ITEM_ID, WptoolItemPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(WptoolAppointmentPeer::APPOINTMENT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(WptoolAppointmentPeer::APPOINTMENT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'WptoolItem';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'description'             => 'Text',
      'rank'                    => 'Number',
      'code'                    => 'Text',
      'wptool_item_type_id'     => 'ForeignKey',
      'wptool_appointment_list' => 'ManyKey',
    );
  }
}
