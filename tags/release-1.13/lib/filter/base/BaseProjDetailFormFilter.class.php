<?php

/**
 * ProjDetail filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjDetailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id'    => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_detail_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjDetailType', 'add_empty' => true)),
      'content'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'schoolproject_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'proj_detail_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjDetailType', 'column' => 'id')),
      'content'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDetail';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'schoolproject_id'    => 'ForeignKey',
      'proj_detail_type_id' => 'ForeignKey',
      'content'             => 'Text',
    );
  }
}
