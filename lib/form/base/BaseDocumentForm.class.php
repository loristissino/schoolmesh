<?php

/**
 * Document form base class.
 *
 * @method Document getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseDocumentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'doctype_id'       => new sfWidgetFormPropelChoice(array('model' => 'Doctype', 'add_empty' => true)),
      'code'             => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'is_form'          => new sfWidgetFormInputCheckbox(),
      'docrevision_id'   => new sfWidgetFormPropelChoice(array('model' => 'Docrevision', 'add_empty' => true)),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'is_deprecated'    => new sfWidgetFormInputCheckbox(),
      'notes'            => new sfWidgetFormInputText(),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'doctype_id'       => new sfValidatorPropelChoice(array('model' => 'Doctype', 'column' => 'id', 'required' => false)),
      'code'             => new sfValidatorString(array('max_length' => 40)),
      'title'            => new sfValidatorString(array('max_length' => 255)),
      'is_form'          => new sfValidatorBoolean(array('required' => false)),
      'docrevision_id'   => new sfValidatorPropelChoice(array('model' => 'Docrevision', 'column' => 'id', 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'is_deprecated'    => new sfValidatorBoolean(array('required' => false)),
      'notes'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('model' => 'SyllabusItem', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Document', 'column' => array('code')))
    );

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }


}
