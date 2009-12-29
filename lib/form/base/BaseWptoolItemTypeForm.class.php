<?php

/**
 * WptoolItemType form base class.
 *
 * @method WptoolItemType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWptoolItemTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'description'  => new sfWidgetFormInputText(),
      'rank'         => new sfWidgetFormInputText(),
      'state'        => new sfWidgetFormInputText(),
      'min_selected' => new sfWidgetFormInputText(),
      'max_selected' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'WptoolItemType', 'column' => 'id', 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'rank'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'min_selected' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'max_selected' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
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
