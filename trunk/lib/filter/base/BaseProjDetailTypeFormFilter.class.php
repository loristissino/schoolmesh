<?php

/**
 * ProjDetailType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjDetailTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_required'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'state_min'             => new sfWidgetFormFilterInput(),
      'state_max'             => new sfWidgetFormFilterInput(),
      'example'               => new sfWidgetFormFilterInput(),
      'missing_value_message' => new sfWidgetFormFilterInput(),
      'filled_value_message'  => new sfWidgetFormFilterInput(),
      'cols'                  => new sfWidgetFormFilterInput(),
      'rows'                  => new sfWidgetFormFilterInput(),
      'rank'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'                  => new sfValidatorPass(array('required' => false)),
      'description'           => new sfValidatorPass(array('required' => false)),
      'label'                 => new sfValidatorPass(array('required' => false)),
      'is_required'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'state_min'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'example'               => new sfValidatorPass(array('required' => false)),
      'missing_value_message' => new sfValidatorPass(array('required' => false)),
      'filled_value_message'  => new sfValidatorPass(array('required' => false)),
      'cols'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rows'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rank'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('proj_detail_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDetailType';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'code'                  => 'Text',
      'description'           => 'Text',
      'label'                 => 'Text',
      'is_required'           => 'Boolean',
      'is_active'             => 'Boolean',
      'state_min'             => 'Number',
      'state_max'             => 'Number',
      'example'               => 'Text',
      'missing_value_message' => 'Text',
      'filled_value_message'  => 'Text',
      'cols'                  => 'Number',
      'rows'                  => 'Number',
      'rank'                  => 'Number',
    );
  }
}
