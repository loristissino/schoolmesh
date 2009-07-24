<?php

/**
 * Wpinfo form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpinfoForm extends BaseFormPropel
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
      'id'             => new sfValidatorPropelChoice(array('model' => 'Wpinfo', 'column' => 'id', 'required' => false)),
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
