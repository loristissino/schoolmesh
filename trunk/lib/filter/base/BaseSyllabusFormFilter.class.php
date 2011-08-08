<?php

/**
 * Syllabus filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSyllabusFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormFilterInput(),
      'version' => new sfWidgetFormFilterInput(),
      'author'  => new sfWidgetFormFilterInput(),
      'href'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'    => new sfValidatorPass(array('required' => false)),
      'version' => new sfValidatorPass(array('required' => false)),
      'author'  => new sfValidatorPass(array('required' => false)),
      'href'    => new sfValidatorPass(array('required' => false)),
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
      'id'      => 'Number',
      'name'    => 'Text',
      'version' => 'Text',
      'author'  => 'Text',
      'href'    => 'Text',
    );
  }
}
