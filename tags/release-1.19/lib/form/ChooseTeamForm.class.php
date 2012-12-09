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
      'notes' => new sfWidgetFormInputText(array(), array('size'=>100)),
      'charge_reference_number' => new sfWidgetFormInputText(array(), array('size'=>20)),
      'confirmation_reference_number' => new sfWidgetFormInputText(array(), array('size'=>20)),
      'expiry' => new sfWidgetFormI18nDate(array('culture'=>sfConfig::get('sf_default_culture'), 'years'=>$years)),  
      )); 
    
    $this['charge_reference_number']->getWidget()->setLabel('Charge<br />reference number');
  	$this['confirmation_reference_number']->getWidget()->setLabel('Confirmation<br />reference number');

    $this->widgetSchema->setNameFormat('info[%s]');
    
    $this->setValidators(array(
        'team_id' => new sfValidatorPropelChoice(array('model'=>'Team', 'required'=>true)),
        'role_id' => new sfValidatorPropelChoice(array('model'=>'Role', 'required'=>true)),
        'notes' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
        'charge_reference_number' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
        'confirmation_reference_number' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
        'expiry' => new sfValidatorDate(array('required'=>false)),
			));
    
  }

  
}
