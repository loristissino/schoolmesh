<?php

/**
 * ProjDetail form base class.
 *
 * @method ProjDetail getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'schoolproject_id'    => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_detail_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjDetailType', 'add_empty' => true)),
      'content'             => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id'    => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'proj_detail_type_id' => new sfValidatorPropelChoice(array('model' => 'ProjDetailType', 'column' => 'id', 'required' => false)),
      'content'             => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDetail';
  }


}
