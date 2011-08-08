<?php

/**
 * WpmoduleItem form base class.
 *
 * @method WpmoduleItem getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseWpmoduleItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'wpitem_group_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemGroup', 'add_empty' => false)),
      'rank'            => new sfWidgetFormInputText(),
      'content'         => new sfWidgetFormTextarea(),
      'evaluation'      => new sfWidgetFormInputText(),
      'is_editable'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'wpitem_group_id' => new sfValidatorPropelChoice(array('model' => 'WpitemGroup', 'column' => 'id')),
      'rank'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'content'         => new sfValidatorString(array('required' => false)),
      'evaluation'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_editable'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'WpmoduleItem', 'column' => array('id', 'rank')))
    );

    $this->widgetSchema->setNameFormat('wpmodule_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpmoduleItem';
  }


}
