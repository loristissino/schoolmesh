<?php

/**
 * WpitemGroup form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpitemGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'wpitem_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemType', 'add_empty' => true)),
      'wpmodule_id'    => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => true)),
      'max_rank'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'WpitemGroup', 'column' => 'id', 'required' => false)),
      'wpitem_type_id' => new sfValidatorPropelChoice(array('model' => 'WpitemType', 'column' => 'id', 'required' => false)),
      'wpmodule_id'    => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id', 'required' => false)),
      'max_rank'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'WpitemGroup', 'column' => array('wpitem_type_id', 'wpmodule_id')))
    );

    $this->widgetSchema->setNameFormat('wpitem_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemGroup';
  }


}
