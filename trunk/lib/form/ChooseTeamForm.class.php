<?php

/**
 * ChooseTeam form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class ChooseTeamForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'team_id' => new sfWidgetFormPropelChoice(array('model'=>'Team', 'add_empty'=>'Choose a team', 'peer_method'=>'doSelect', )),
      'role_id' => new sfWidgetFormPropelChoice(array('model'=>'Role', 'add_empty'=>'Choose a role', 'peer_method'=>'doSelect', ))
      )); 
    
    $this->setValidators(array(
        'team_id' => new sfValidatorPropelChoice(array('model'=>'Team', 'required'=>true)),
        'role_id' => new sfValidatorPropelChoice(array('model'=>'Role', 'required'=>true)),
			));
    
  }

  
}
