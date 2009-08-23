<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Ticket filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseTicketFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'referrer'       => new sfWidgetFormFilterInput(),
      'ticket_type_id' => new sfWidgetFormPropelChoice(array('model' => 'TicketType', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'state'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'referrer'       => new sfValidatorPass(array('required' => false)),
      'ticket_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TicketType', 'column' => 'id')),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'state'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ticket_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ticket';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'referrer'       => 'Text',
      'ticket_type_id' => 'ForeignKey',
      'updated_at'     => 'Date',
      'state'          => 'Number',
    );
  }
}
