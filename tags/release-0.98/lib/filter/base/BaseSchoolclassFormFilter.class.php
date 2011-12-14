<?php

/**
 * Schoolclass filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
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
    ));

    $this->setValidators(array(
      'grade'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'section'     => new sfValidatorPass(array('required' => false)),
      'track_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Track', 'column' => 'id')),
      'description' => new sfValidatorPass(array('required' => false)),
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
    );
  }
}
