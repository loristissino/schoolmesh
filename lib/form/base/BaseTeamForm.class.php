<?php

/**
 * Team form base class.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTeamForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'description'  => new sfWidgetFormInput(),
      'posix_name'   => new sfWidgetFormInput(),
      'quality_code' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Team', 'column' => 'id', 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'posix_name'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'quality_code' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }


}
