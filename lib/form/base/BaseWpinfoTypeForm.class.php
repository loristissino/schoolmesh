<?php

/**
 * WpinfoType form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpinfoTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'description' => new sfWidgetFormInput(),
      'rank'        => new sfWidgetFormInput(),
      'state'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'WpinfoType', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'rank'        => new sfValidatorInteger(),
      'state'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpinfoType';
  }


}
