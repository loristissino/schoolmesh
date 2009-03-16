<?php

/**
 * WpmoduleItem form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpmoduleItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'wpitem_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemType', 'add_empty' => true)),
      'wpmodule_id'    => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => true)),
      'rank'           => new sfWidgetFormInput(),
      'content'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'WpmoduleItem', 'column' => 'id', 'required' => false)),
      'wpitem_type_id' => new sfValidatorPropelChoice(array('model' => 'WpitemType', 'column' => 'id', 'required' => false)),
      'wpmodule_id'    => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id', 'required' => false)),
      'rank'           => new sfValidatorInteger(),
      'content'        => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'WpmoduleItem', 'column' => array('wpmodule_id', 'wpitem_type_id', 'rank')))
    );

    $this->widgetSchema->setNameFormat('wpmodule_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpmoduleItem';
  }


}
