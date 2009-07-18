<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SystemMessageI18n filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseSystemMessageI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'content' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'content' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('system_message_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemMessageI18n';
  }

  public function getFields()
  {
    return array(
      'content' => 'Text',
      'id'      => 'ForeignKey',
      'culture' => 'Text',
    );
  }
}
