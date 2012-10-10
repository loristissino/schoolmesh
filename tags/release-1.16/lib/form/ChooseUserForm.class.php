<?php

/**
 * ChooseUser form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class ChooseUserForm extends BaseForm
{
  public function configure()
  {
    
    $peer_method=array_key_exists('peer_method', $this->options) ? $this->options['peer_method'] : 'doSelect';
    $add_empty=array_key_exists('add_empty', $this->options) ? $this->options['add_empty'] : 'Choose a user';
        
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'add_empty'=>$add_empty, 'peer_method'=>$peer_method)),
      )); 
    
    $this->widgetSchema->setNameFormat('info[%s]');

    $this->setValidators(array(
        'user_id' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile', 'required'=>true)),
			));
    
  }

  
}
