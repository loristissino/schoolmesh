<?php

/**
 * WpitemType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpitemTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                      => new sfWidgetFormFilterInput(),
      'singular'                   => new sfWidgetFormFilterInput(),
      'description'                => new sfWidgetFormFilterInput(),
      'style'                      => new sfWidgetFormFilterInput(),
      'rank'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'                      => new sfWidgetFormFilterInput(),
      'is_required'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'syllabus_id'                => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'code'                       => new sfWidgetFormFilterInput(),
      'evaluation_min'             => new sfWidgetFormFilterInput(),
      'evaluation_max'             => new sfWidgetFormFilterInput(),
      'evaluation_min_description' => new sfWidgetFormFilterInput(),
      'evaluation_max_description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'                      => new sfValidatorPass(array('required' => false)),
      'singular'                   => new sfValidatorPass(array('required' => false)),
      'description'                => new sfValidatorPass(array('required' => false)),
      'style'                      => new sfValidatorPass(array('required' => false)),
      'rank'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_required'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'syllabus_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Syllabus', 'column' => 'id')),
      'code'                       => new sfValidatorPass(array('required' => false)),
      'evaluation_min'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_min_description' => new sfValidatorPass(array('required' => false)),
      'evaluation_max_description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpitem_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemType';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'title'                      => 'Text',
      'singular'                   => 'Text',
      'description'                => 'Text',
      'style'                      => 'Text',
      'rank'                       => 'Number',
      'state'                      => 'Number',
      'is_required'                => 'Boolean',
      'syllabus_id'                => 'ForeignKey',
      'code'                       => 'Text',
      'evaluation_min'             => 'Number',
      'evaluation_max'             => 'Number',
      'evaluation_min_description' => 'Text',
      'evaluation_max_description' => 'Text',
    );
  }
}
