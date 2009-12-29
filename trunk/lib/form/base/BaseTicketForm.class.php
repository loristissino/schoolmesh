<?php

/**
 * Ticket form base class.
 *
 * @method Ticket getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTicketForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'referrer'       => new sfWidgetFormInputText(),
      'ticket_type_id' => new sfWidgetFormPropelChoice(array('model' => 'TicketType', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormDateTime(),
      'state'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Ticket', 'column' => 'id', 'required' => false)),
      'referrer'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ticket_type_id' => new sfValidatorPropelChoice(array('model' => 'TicketType', 'column' => 'id', 'required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'state'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
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
