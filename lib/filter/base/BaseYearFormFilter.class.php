<?php

/**
 * Year filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseYearFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('year_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Year';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'description' => 'Text',
    );
  }
}
