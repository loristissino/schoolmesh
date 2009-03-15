<?php

/**
 * Schoolclass form base class.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseSchoolclassForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'grade'       => new sfWidgetFormInput(),
      'section'     => new sfWidgetFormInput(),
      'track_id'    => new sfWidgetFormPropelChoice(array('model' => 'Track', 'add_empty' => true)),
      'description' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id', 'required' => false)),
      'grade'       => new sfValidatorInteger(),
      'section'     => new sfValidatorString(array('max_length' => 3)),
      'track_id'    => new sfValidatorPropelChoice(array('model' => 'Track', 'column' => 'id', 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schoolclass[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolclass';
  }


}
