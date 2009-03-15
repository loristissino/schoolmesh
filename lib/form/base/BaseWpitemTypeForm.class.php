<?php

/**
 * WpitemType form base class.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpitemTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'description' => new sfWidgetFormInput(),
      'rank'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'WpitemType', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'rank'        => new sfValidatorInteger(),
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
