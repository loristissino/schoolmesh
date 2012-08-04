<?php

/**
 * Workstation filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWorkstationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'ip_cidr'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mac_address' => new sfWidgetFormFilterInput(),
      'is_enabled'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'location_x'  => new sfWidgetFormFilterInput(),
      'location_y'  => new sfWidgetFormFilterInput(),
      'subnet_id'   => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'ip_cidr'     => new sfValidatorPass(array('required' => false)),
      'mac_address' => new sfValidatorPass(array('required' => false)),
      'is_enabled'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'location_x'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'location_y'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'subnet_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subnet', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('workstation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Workstation';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'ip_cidr'     => 'Text',
      'mac_address' => 'Text',
      'is_enabled'  => 'Boolean',
      'is_active'   => 'Boolean',
      'location_x'  => 'Number',
      'location_y'  => 'Number',
      'subnet_id'   => 'ForeignKey',
    );
  }
}
