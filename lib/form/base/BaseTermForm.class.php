<?php

/**
 * Term form base class.
 *
 * @method Term getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTermForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'description'           => new sfWidgetFormInputText(),
      'end_day'               => new sfWidgetFormInputText(),
      'has_formal_evaluation' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Term', 'column' => 'id', 'required' => false)),
      'description'           => new sfValidatorString(array('max_length' => 100)),
      'end_day'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'has_formal_evaluation' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('term[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Term';
  }


}
