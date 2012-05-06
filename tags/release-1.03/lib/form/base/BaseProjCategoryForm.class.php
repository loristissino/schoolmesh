<?php

/**
 * ProjCategory form base class.
 *
 * @method ProjCategory getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'title'     => new sfWidgetFormInputText(),
      'rank'      => new sfWidgetFormInputText(),
      'resources' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rank'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resources' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjCategory';
  }


}
