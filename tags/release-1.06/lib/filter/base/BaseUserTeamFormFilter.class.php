<?php

/**
 * UserTeam filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseUserTeamFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'team_id'          => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'role_id'          => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'expiry'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'notes'            => new sfWidgetFormFilterInput(),
      'reference_number' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'team_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Team', 'column' => 'id')),
      'role_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'expiry'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'notes'            => new sfValidatorPass(array('required' => false)),
      'reference_number' => new sfValidatorPass(array('required' => false)),
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
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'team_id'          => 'ForeignKey',
      'role_id'          => 'ForeignKey',
      'expiry'           => 'Date',
      'notes'            => 'Text',
      'reference_number' => 'Text',
    );
  }
}
