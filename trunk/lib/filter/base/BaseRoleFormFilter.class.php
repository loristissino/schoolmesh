<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Role filter form base class.
 *
 * @package    mattiussi
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRoleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'  => new sfWidgetFormFilterInput(),
      'quality_code' => new sfWidgetFormFilterInput(),
      'posix_name'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'  => new sfValidatorPass(array('required' => false)),
      'quality_code' => new sfValidatorPass(array('required' => false)),
      'posix_name'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('role_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'description'  => 'Text',
      'quality_code' => 'Text',
      'posix_name'   => 'Text',
    );
  }
}
