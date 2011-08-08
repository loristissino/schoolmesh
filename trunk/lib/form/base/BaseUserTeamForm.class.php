<?php

/**
 * UserTeam form base class.
 *
 * @method UserTeam getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserTeamForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'team_id' => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => false)),
      'role_id' => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'team_id' => new sfValidatorPropelChoice(array('model' => 'Team', 'column' => 'id')),
      'role_id' => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UserTeam', 'column' => array('user_id', 'team_id')))
    );

    $this->widgetSchema->setNameFormat('user_team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserTeam';
  }


}
