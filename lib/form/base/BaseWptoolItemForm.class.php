<?php

/**
 * WptoolItem form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWptoolItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'description'         => new sfWidgetFormInput(),
      'wptool_item_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItemType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'WptoolItem', 'column' => 'id', 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'wptool_item_type_id' => new sfValidatorPropelChoice(array('model' => 'WptoolItemType', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wptool_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItem';
  }


}
