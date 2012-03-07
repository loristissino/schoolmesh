<?php

/**
 * WptoolItemType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWptoolItemTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'         => new sfWidgetFormFilterInput(),
      'rank'                => new sfWidgetFormFilterInput(),
      'appointment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AppointmentType', 'add_empty' => true)),
      'state'               => new sfWidgetFormFilterInput(),
      'min_selected'        => new sfWidgetFormFilterInput(),
      'max_selected'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'         => new sfValidatorPass(array('required' => false)),
      'rank'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'appointment_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AppointmentType', 'column' => 'id')),
      'state'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_selected'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_selected'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wptool_item_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItemType';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'description'         => 'Text',
      'rank'                => 'Number',
      'appointment_type_id' => 'ForeignKey',
      'state'               => 'Number',
      'min_selected'        => 'Number',
      'max_selected'        => 'Number',
    );
  }
}
