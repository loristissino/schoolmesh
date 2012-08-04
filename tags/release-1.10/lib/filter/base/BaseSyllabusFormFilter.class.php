<?php

/**
 * Syllabus filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSyllabusFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                       => new sfWidgetFormFilterInput(),
      'version'                    => new sfWidgetFormFilterInput(),
      'author'                     => new sfWidgetFormFilterInput(),
      'href'                       => new sfWidgetFormFilterInput(),
      'is_active'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'evaluation_min'             => new sfWidgetFormFilterInput(),
      'evaluation_max'             => new sfWidgetFormFilterInput(),
      'evaluation_min_description' => new sfWidgetFormFilterInput(),
      'evaluation_max_description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                       => new sfValidatorPass(array('required' => false)),
      'version'                    => new sfValidatorPass(array('required' => false)),
      'author'                     => new sfValidatorPass(array('required' => false)),
      'href'                       => new sfValidatorPass(array('required' => false)),
      'is_active'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'evaluation_min'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_min_description' => new sfValidatorPass(array('required' => false)),
      'evaluation_max_description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('syllabus_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Syllabus';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'name'                       => 'Text',
      'version'                    => 'Text',
      'author'                     => 'Text',
      'href'                       => 'Text',
      'is_active'                  => 'Boolean',
      'evaluation_min'             => 'Number',
      'evaluation_max'             => 'Number',
      'evaluation_min_description' => 'Text',
      'evaluation_max_description' => 'Text',
    );
  }
}
