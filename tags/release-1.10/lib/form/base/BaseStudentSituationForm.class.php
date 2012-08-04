<?php

/**
 * StudentSituation form base class.
 *
 * @method StudentSituation getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseStudentSituationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'term_id'          => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => false)),
      'wpmodule_item_id' => new sfWidgetFormPropelChoice(array('model' => 'WpmoduleItem', 'add_empty' => false)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'evaluation'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'term_id'          => new sfValidatorPropelChoice(array('model' => 'Term', 'column' => 'id')),
      'wpmodule_item_id' => new sfValidatorPropelChoice(array('model' => 'WpmoduleItem', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'evaluation'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StudentSituation', 'column' => array('term_id', 'wpmodule_item_id', 'user_id')))
    );

    $this->widgetSchema->setNameFormat('student_situation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSituation';
  }


}
