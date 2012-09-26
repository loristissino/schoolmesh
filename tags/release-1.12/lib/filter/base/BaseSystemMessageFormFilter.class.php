<?php

/**
 * SystemMessage filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSystemMessageFormFilter extends BaseFormFilterPropel
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
