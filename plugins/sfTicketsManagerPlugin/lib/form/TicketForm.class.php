<?php

/**
 * Ticket form.
 *
 * @package    sfTicketManagerPlugin
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class TicketForm extends BaseTicketForm
{
  public function configure()
  {
      unset(
        $this['updated_at'],
        $this['state']
      );
      
      $this->widgetSchema['referrer'] = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
      $this['ticket_type_id']->getWidget()->setOption('add_empty', 'Choose a ticket type');
      
      $this->widgetSchema->setNameFormat('info[%s]');
    
      $this->setValidators(array(
          'id'=>new sfValidatorInteger(array('required'=>false)),
          'referrer' => new sfValidatorString(array('required'=>false, 'trim'=>true)),
          'ticket_type_id' => new sfValidatorPropelChoice(array('required'=>true, 'model'=>'TicketType')),
          'content' => new sfValidatorString(array('required'=>true, 'trim'=>true)),
      ));

      
      
      
  }
}
