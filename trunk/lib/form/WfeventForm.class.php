<?php

/**
 * Wfevent form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
class WfeventForm extends BaseWfeventForm
{
  public function configure()
  {
    unset(
      $this['id'],
      $this['base_table'],
      $this['base_id']
      );
      
    $this->setWidget('created_at', new sfWidgetFormI18nDateTime(array('culture'=>'it')));
    
    $this['comment']->getWidget()
      ->setAttributes(array('size'=>'80'))
      ;
    $this['state']->getWidget()
      ->setAttributes(array('size'=>'5'))
      ;
    
    $this->widgetSchema['update_state'] = new sfWidgetFormInputCheckbox();

    $this['created_at']->getWidget()->setLabel('Event date');

    $this->widgetSchema->setNameFormat('info[%s]');
    
    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),  
      'created_at' => new sfValidatorDateTime(),
      'comment' => new sfValidatorString(array('trim' => true, 'required' => true, 'max_length'=>255)),
      'state' => new sfValidatorInteger(),
      'update_state' => new sfValidatorPass()
    ));

    $object=$this->getObject();
    
    if(!$object->getCreatedAt())
    {
    	$this->setDefault('created_at', time());
		}
    
    switch($object->getBaseTable())
    {
      case WfeventPeer::PROJ_DEADLINE:
        break;
      case WfeventPeer::SCHOOLPROJECT:
        break;
      case WfeventPeer::APPOINTMENT:
        $this->setWidget('user_id', new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'peer_method'=>'retrieveAllButStudents', 'add_empty'=>'Choose a user')));
        
        break;
    }
  }
}
