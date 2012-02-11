<?php

/**
 * Wpinfo form base class.
 *
 * @method Wpinfo getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpinfoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'wpinfo_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpinfoType', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormDateTime(),
      'content'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'appointment_id' => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'wpinfo_type_id' => new sfValidatorPropelChoice(array('model' => 'WpinfoType', 'column' => 'id', 'required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'content'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpinfo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpinfo';
  }


}
