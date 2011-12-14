<?php

/**
 * Term filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTermFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_day'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'has_formal_evaluation' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'           => new sfValidatorPass(array('required' => false)),
      'end_day'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'has_formal_evaluation' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('term_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Term';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Text',
      'description'           => 'Text',
      'end_day'               => 'Number',
      'has_formal_evaluation' => 'Boolean',
    );
  }
}
