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
    
    $years=Generic::getNumbersBetweenAsOptionsArray(sfConfig::get('app_config_current_year'), sfConfig::get('app_config_current_year')+5);
    
    $this->setWidgets(array(
      'team_id' => new sfWidgetFormPropelChoice(array('model'=>'Team', 'add_empty'=>'Choose a team', 'peer_method'=>'retrieveAll', )),
      'role_id' => new sfWidgetFormPropelChoice(array('model'=>'Role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveAll', )),
      'expiry' => new sfWidgetFormI18nDate(array('culture'=>sfConfig::get('sf_default_culture'), 'years'=>$years)),  
      )); 
    
    $this->widgetSchema->setNameFormat('info[%s]');
    
    $this->setValidators(array(
        'team_id' => new sfValidatorPropelChoice(array('model'=>'Team', 'required'=>true)),
        'role_id' => new sfValidatorPropelChoice(array('model'=>'Role', 'required'=>true)),
        'expiry' => new sfValidatorDate(array('required'=>false)),
			));
    
  }

  
}
