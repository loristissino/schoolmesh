<?php

/**
 * Schoolproject form base class.
 *
 * @method Schoolproject getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSchoolprojectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'proj_category_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'year_id'          => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'title'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'hours_approved'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'proj_category_id' => new sfValidatorPropelChoice(array('model' => 'ProjCategory', 'column' => 'id', 'required' => false)),
      'year_id'          => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'hours_approved'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schoolproject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolproject';
  }


}
