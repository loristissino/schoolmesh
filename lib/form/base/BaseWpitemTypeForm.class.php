<?php

/**
 * WpitemType form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpitemTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'title'                      => new sfWidgetFormInput(),
      'singular'                   => new sfWidgetFormInput(),
      'description'                => new sfWidgetFormInput(),
      'style'                      => new sfWidgetFormInput(),
      'rank'                       => new sfWidgetFormInput(),
      'state'                      => new sfWidgetFormInput(),
      'is_required'                => new sfWidgetFormInputCheckbox(),
      'evaluation_min'             => new sfWidgetFormInput(),
      'evaluation_max'             => new sfWidgetFormInput(),
      'evaluation_min_description' => new sfWidgetFormInput(),
      'evaluation_max_description' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorPropelChoice(array('model' => 'WpitemType', 'column' => 'id', 'required' => false)),
      'title'                      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'singular'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'                => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'style'                      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'rank'                       => new sfValidatorInteger(),
      'state'                      => new sfValidatorInteger(array('required' => false)),
      'is_required'                => new sfValidatorBoolean(array('required' => false)),
      'evaluation_min'             => new sfValidatorInteger(array('required' => false)),
      'evaluation_max'             => new sfValidatorInteger(array('required' => false)),
      'evaluation_min_description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'evaluation_max_description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpitem_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemType';
  }


}