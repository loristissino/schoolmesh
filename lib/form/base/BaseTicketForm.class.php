<?php

/**
 * Ticket form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTicketForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'referrer'       => new sfWidgetFormInput(),
      'ticket_type_id' => new sfWidgetFormPropelChoice(array('model' => 'TicketType', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormDateTime(),
      'state'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Ticket', 'column' => 'id', 'required' => false)),
      'referrer'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ticket_type_id' => new sfValidatorPropelChoice(array('model' => 'TicketType', 'column' => 'id', 'required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'state'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ticket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ticket';
  }


}
