<?php

/**
 * WptoolItemType form base class.
 *
 * @method WptoolItemType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWptoolItemTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'description'         => new sfWidgetFormInputText(),
      'rank'                => new sfWidgetFormInputText(),
      'appointment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AppointmentType', 'add_empty' => true)),
      'state'               => new sfWidgetFormInputText(),
      'min_selected'        => new sfWidgetFormInputText(),
      'max_selected'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'rank'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'appointment_type_id' => new sfValidatorPropelChoice(array('model' => 'AppointmentType', 'column' => 'id', 'required' => false)),
      'state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'min_selected'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'max_selected'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wptool_item_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItemType';
  }


}
