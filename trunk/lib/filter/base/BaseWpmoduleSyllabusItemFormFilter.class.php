<?php

/**
 * WpmoduleSyllabusItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseWpmoduleSyllabusItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'wpmodule_id'      => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => true)),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
      'contribution'     => new sfWidgetFormFilterInput(),
      'evalutation'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'wpmodule_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Wpmodule', 'column' => 'id')),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SyllabusItem', 'column' => 'id')),
      'contribution'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evalutation'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wpmodule_syllabus_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpmoduleSyllabusItem';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'wpmodule_id'      => 'ForeignKey',
      'syllabus_item_id' => 'ForeignKey',
      'contribution'     => 'Number',
      'evalutation'      => 'Number',
    );
  }
}
