<?php

/**
 * UserTeam form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseUserTeamForm extends BaseFormPropel
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
      'id'      => new sfValidatorPropelChoice(array('model' => 'UserTeam', 'column' => 'id', 'required' => false)),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'team_id' => new sfValidatorPropelChoice(array('model' => 'Team', 'column' => 'id')),
      'role_id' => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UserTeam', 'column' => array('user_id', 'team_id', 'role_id')))
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
