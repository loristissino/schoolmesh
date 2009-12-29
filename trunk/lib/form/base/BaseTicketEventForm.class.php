<?php

/**
 * TicketEvent form base class.
 *
 * @method TicketEvent getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTicketEventForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'ticket_id'   => new sfWidgetFormPropelChoice(array('model' => 'Ticket', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'content'     => new sfWidgetFormInputText(),
      'state'       => new sfWidgetFormInputText(),
      'assignee_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'TicketEvent', 'column' => 'id', 'required' => false)),
      'ticket_id'   => new sfValidatorPropelChoice(array('model' => 'Ticket', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'content'     => new sfValidatorString(array('max_length' => 255)),
      'state'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
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
