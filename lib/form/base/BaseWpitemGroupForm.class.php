<?php

/**
 * WpitemGroup form base class.
 *
 * @method WpitemGroup getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpitemGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'wpitem_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemType', 'add_empty' => true)),
      'wpmodule_id'    => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'wpitem_type_id' => new sfValidatorPropelChoice(array('model' => 'WpitemType', 'column' => 'id', 'required' => false)),
      'wpmodule_id'    => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'WpitemGroup', 'column' => array('wpitem_type_id', 'wpmodule_id')))
    );

    $this->widgetSchema->setNameFormat('wpitem_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemGroup';
  }


}
