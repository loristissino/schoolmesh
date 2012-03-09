<?php

/**
 * AppointmentType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseAppointmentTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'     => new sfWidgetFormFilterInput(),
      'shortcut'        => new sfWidgetFormFilterInput(),
      'rank'            => new sfWidgetFormFilterInput(),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_info'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_modules'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_tools'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_attachments' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'     => new sfValidatorPass(array('required' => false)),
      'shortcut'        => new sfValidatorPass(array('required' => false)),
      'rank'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_info'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_modules'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_tools'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_attachments' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('appointment_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AppointmentType';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'description'     => 'Text',
      'shortcut'        => 'Text',
      'rank'            => 'Number',
      'is_active'       => 'Boolean',
      'has_info'        => 'Boolean',
      'has_modules'     => 'Boolean',
      'has_tools'       => 'Boolean',
      'has_attachments' => 'Boolean',
    );
  }
}
