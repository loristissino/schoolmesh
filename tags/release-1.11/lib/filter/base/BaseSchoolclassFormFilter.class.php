<?php

/**
 * Schoolclass filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSchoolclassFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'grade'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'section'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'track_id'    => new sfWidgetFormPropelChoice(array('model' => 'Track', 'add_empty' => true)),
      'description' => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'grade'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'section'     => new sfValidatorPass(array('required' => false)),
      'track_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Track', 'column' => 'id')),
      'description' => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('schoolclass_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolclass';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Text',
      'grade'       => 'Number',
      'section'     => 'Text',
      'track_id'    => 'ForeignKey',
      'description' => 'Text',
      'is_active'   => 'Boolean',
    );
  }
}
