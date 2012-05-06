<?php

/**
 * WpmoduleSyllabusItem form base class.
 *
 * @method WpmoduleSyllabusItem getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpmoduleSyllabusItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'wpmodule_id'      => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => true)),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
      'contribution'     => new sfWidgetFormInputText(),
      'evaluation'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'wpmodule_id'      => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id', 'required' => false)),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('model' => 'SyllabusItem', 'column' => 'id', 'required' => false)),
      'contribution'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'evaluation'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'WpmoduleSyllabusItem', 'column' => array('wpmodule_id', 'syllabus_item_id')))
    );

    $this->widgetSchema->setNameFormat('wpmodule_syllabus_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpmoduleSyllabusItem';
  }


}
