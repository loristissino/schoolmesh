<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SystemMessage filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseSystemMessageFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'key' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'key' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('system_message_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemMessage';
  }

  public function getFields()
  {
    return array(
      'id'  => 'Number',
      'key' => 'Text',
    );
  }
}
