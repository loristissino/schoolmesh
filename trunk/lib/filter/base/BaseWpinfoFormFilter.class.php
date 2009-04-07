<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Wpinfo filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWpinfoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'wpinfo_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpinfoType', 'add_empty' => true)),
      'content'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'appointment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Appointment', 'column' => 'id')),
      'wpinfo_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WpinfoType', 'column' => 'id')),
      'content'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpinfo';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'appointment_id' => 'ForeignKey',
      'wpinfo_type_id' => 'ForeignKey',
      'content'        => 'Text',
    );
  }
}
