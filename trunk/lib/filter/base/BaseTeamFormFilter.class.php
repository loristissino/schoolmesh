<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Team filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseTeamFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'  => new sfWidgetFormFilterInput(),
      'posix_name'   => new sfWidgetFormFilterInput(),
      'quality_code' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'  => new sfValidatorPass(array('required' => false)),
      'posix_name'   => new sfValidatorPass(array('required' => false)),
      'quality_code' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'description'  => 'Text',
      'posix_name'   => 'Text',
      'quality_code' => 'Text',
    );
  }
}
