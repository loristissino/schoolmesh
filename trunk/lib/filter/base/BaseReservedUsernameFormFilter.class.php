<?php

/**
 * ReservedUsername filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseReservedUsernameFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'   => new sfWidgetFormFilterInput(),
      'aliases_to' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'   => new sfValidatorPass(array('required' => false)),
      'aliases_to' => new sfValidatorPass(array('required' => false)),
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
      'id'         => 'Number',
      'username'   => 'Text',
      'aliases_to' => 'Text',
    );
  }
}
