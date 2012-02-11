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
      'subnet_id'   => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'ip_cidr'     => new sfValidatorPass(array('required' => false)),
      'mac_address' => new sfValidatorPass(array('required' => false)),
      'is_enabled'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'subnet_id'   => 'ForeignKey',
    );
  }
}
