<?php

/**
 * UserTeam form.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class UserTeamForm extends BaseUserTeamForm
{
  public function configure()
  {
    unset(
      $this['id'],
      $this['details']
      );
    $years=Generic::getNumbersBetweenAsOptionsArray(sfConfig::get('app_config_current_year'), sfConfig::get('app_config_current_year')+5);

    $this->widgetSchema['user_id'] = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
    $this->widgetSchema['team_id'] = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
    
    $this->widgetSchema['expiry'] = new sfWidgetFormI18nDate(array('culture'=>sfConfig::get('sf_default_culture'), 'years'=>$years));
    
    $this['role_id']->getWidget()->setOption('peer_method', 'retrieveAll');
  	$this['role_id']->getWidget()->setOption('add_empty', 'Choose a role');

  	$this['charge_reference_number']->getWidget()->setLabel('Charge<br />reference number');
  	$this['confirmation_reference_number']->getWidget()->setLabel('Confirmation<br />reference number');
    
    $this->widgetSchema->setNameFormat('info[%s]');
    
    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),
      'team_id' => new sfValidatorPropelChoice(array('model'=>'Team')),
      'role_id' => new sfValidatorPropelChoice(array('model'=>'Role')), 
      'expiry' => new sfValidatorDate(array('required'=>false)),
      'notes' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
      'charge_reference_number' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
      'confirmation_reference_number' => new sfValidatorString(array('required'=>false, 'trim'=>true))
    ));

    
    

  }
}
