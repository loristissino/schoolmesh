<?php

/**
 * ProjUpshot filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjUpshotFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'description'      => new sfWidgetFormFilterInput(),
      'indicator'        => new sfWidgetFormFilterInput(),
      'upshot'           => new sfWidgetFormFilterInput(),
      'evaluation'       => new sfWidgetFormFilterInput(),
      'scheduled_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'schoolproject_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'description'      => new sfValidatorPass(array('required' => false)),
      'indicator'        => new sfValidatorPass(array('required' => false)),
      'upshot'           => new sfValidatorPass(array('required' => false)),
      'evaluation'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'scheduled_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('proj_upshot_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjUpshot';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'schoolproject_id' => 'ForeignKey',
      'description'      => 'Text',
      'indicator'        => 'Text',
      'upshot'           => 'Text',
      'evaluation'       => 'Number',
      'scheduled_date'   => 'Date',
    );
  }
}
