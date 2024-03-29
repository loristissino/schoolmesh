<?php

/**
 * WpinfoType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpinfoTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'               => new sfWidgetFormFilterInput(),
      'description'         => new sfWidgetFormFilterInput(),
      'rank'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'code'                => new sfWidgetFormFilterInput(),
      'state_min'           => new sfWidgetFormFilterInput(),
      'state_max'           => new sfWidgetFormFilterInput(),
      'template'            => new sfWidgetFormFilterInput(),
      'example'             => new sfWidgetFormFilterInput(),
      'is_required'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_confidential'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'grade_min'           => new sfWidgetFormFilterInput(),
      'grade_max'           => new sfWidgetFormFilterInput(),
      'appointment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AppointmentType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'title'               => new sfValidatorPass(array('required' => false)),
      'description'         => new sfValidatorPass(array('required' => false)),
      'rank'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code'                => new sfValidatorPass(array('required' => false)),
      'state_min'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state_max'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'template'            => new sfValidatorPass(array('required' => false)),
      'example'             => new sfValidatorPass(array('required' => false)),
      'is_required'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_confidential'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'grade_min'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grade_max'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'appointment_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AppointmentType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpinfoType';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'title'               => 'Text',
      'description'         => 'Text',
      'rank'                => 'Number',
      'code'                => 'Text',
      'state_min'           => 'Number',
      'state_max'           => 'Number',
      'template'            => 'Text',
      'example'             => 'Text',
      'is_required'         => 'Boolean',
      'is_confidential'     => 'Boolean',
      'grade_min'           => 'Number',
      'grade_max'           => 'Number',
      'appointment_type_id' => 'ForeignKey',
    );
  }
}
