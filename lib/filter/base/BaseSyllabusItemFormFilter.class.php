<?php

/**
 * SyllabusItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSyllabusItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'syllabus_id'   => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'rank'          => new sfWidgetFormFilterInput(),
      'ref'           => new sfWidgetFormFilterInput(),
      'level'         => new sfWidgetFormFilterInput(),
      'parent_id'     => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
      'content'       => new sfWidgetFormFilterInput(),
      'is_selectable' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'syllabus_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Syllabus', 'column' => 'id')),
      'rank'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ref'           => new sfValidatorPass(array('required' => false)),
      'level'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parent_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SyllabusItem', 'column' => 'id')),
      'content'       => new sfValidatorPass(array('required' => false)),
      'is_selectable' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('syllabus_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SyllabusItem';
  }

  public function getFields()
  {
    return array(
      'syllabus_id'   => 'ForeignKey',
      'id'            => 'Number',
      'rank'          => 'Number',
      'ref'           => 'Text',
      'level'         => 'Number',
      'parent_id'     => 'ForeignKey',
      'content'       => 'Text',
      'is_selectable' => 'Boolean',
    );
  }
}
