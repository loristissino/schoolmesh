<?php

/**
 * TicketEvent form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTicketEventForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'ticket_id'   => new sfWidgetFormPropelChoice(array('model' => 'Ticket', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'content'     => new sfWidgetFormInput(),
      'state'       => new sfWidgetFormInput(),
      'assignee_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'TicketEvent', 'column' => 'id', 'required' => false)),
      'ticket_id'   => new sfValidatorPropelChoice(array('model' => 'Ticket', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'content'     => new sfValidatorString(array('max_length' => 255)),
      'state'       => new sfValidatorInteger(array('required' => false)),
      'assignee_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ticket_event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TicketEvent';
  }


}
