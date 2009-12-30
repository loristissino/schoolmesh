<?php

/**
 * Year form base class.
 *
 * @method Year getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseYearForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormInputText(),
      'start_date'  => new sfWidgetFormDate(),
      'end_date'    => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id', 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'start_date'  => new sfValidatorDate(array('required' => false)),
      'end_date'    => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('year[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Year';
  }


}
