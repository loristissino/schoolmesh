<?php

/**
 * Wpmodule form base class.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpmoduleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'shortcut'   => new sfWidgetFormInput(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'      => new sfWidgetFormInput(),
      'period'     => new sfWidgetFormInput(),
      'is_public'  => new sfWidgetFormInputCheckbox(),
      'is_locked'  => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id', 'required' => false)),
      'shortcut'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'period'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'is_public'  => new sfValidatorBoolean(array('required' => false)),
      'is_locked'  => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Wpmodule', 'column' => array('user_id', 'shortcut')))
    );

    $this->widgetSchema->setNameFormat('wpmodule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpmodule';
  }


}
