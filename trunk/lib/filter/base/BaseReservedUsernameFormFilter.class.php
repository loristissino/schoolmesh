<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ReservedUsername filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseReservedUsernameFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reserved_username_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReservedUsername';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'username' => 'Text',
    );
  }
}
