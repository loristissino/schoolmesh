<?php

/**
 * Wfevent filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWfeventFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'base_table' => new sfWidgetFormFilterInput(),
      'base_id'    => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'comment'    => new sfWidgetFormFilterInput(),
      'state'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'base_table' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'base_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'comment'    => new sfValidatorPass(array('required' => false)),
      'state'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wfevent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wfevent';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'base_table' => 'Number',
      'base_id'    => 'Number',
      'created_at' => 'Date',
      'user_id'    => 'ForeignKey',
      'comment'    => 'Text',
      'state'      => 'Number',
    );
  }
}
