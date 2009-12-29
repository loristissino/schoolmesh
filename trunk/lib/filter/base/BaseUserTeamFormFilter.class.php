<?php

/**
 * UserTeam filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseUserTeamFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'team_id' => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'role_id' => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'team_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Team', 'column' => 'id')),
      'role_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('user_team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserTeam';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'user_id' => 'ForeignKey',
      'team_id' => 'ForeignKey',
      'role_id' => 'ForeignKey',
    );
  }
}
