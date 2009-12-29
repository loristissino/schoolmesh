<?php

/**
 * SystemMessageI18n filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSystemMessageI18nFormFilter extends BaseFormFilterPropel
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
