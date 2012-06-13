<?php

/**
 * TicketEvent filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseTicketEventFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ticket_id'   => new sfWidgetFormPropelChoice(array('model' => 'Ticket', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'content'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'       => new sfWidgetFormFilterInput(),
      'assignee_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ticket_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Ticket', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'content'     => new sfValidatorPass(array('required' => false)),
      'state'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'assignee_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ticket_event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TicketEvent';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'ticket_id'   => 'ForeignKey',
      'user_id'     => 'ForeignKey',
      'created_at'  => 'Date',
      'content'     => 'Text',
      'state'       => 'Number',
      'assignee_id' => 'ForeignKey',
    );
  }
}
