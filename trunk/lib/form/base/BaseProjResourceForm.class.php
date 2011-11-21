<?php

/**
 * ProjResource form base class.
 *
 * @method ProjResource getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjResourceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'schoolproject_id'         => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_resource_type_id'    => new sfWidgetFormPropelChoice(array('model' => 'ProjResourceType', 'add_empty' => true)),
      'description'              => new sfWidgetFormInputText(),
      'charged_user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'quantity_estimated'       => new sfWidgetFormInputText(),
      'quantity_approved'        => new sfWidgetFormInputText(),
      'amount_estimated'         => new sfWidgetFormInputText(),
      'amount_funded_externally' => new sfWidgetFormInputText(),
      'financing_notes'          => new sfWidgetFormInputText(),
      'quantity_final'           => new sfWidgetFormInputText(),
      'standard_cost'            => new sfWidgetFormInputText(),
      'is_monetary'              => new sfWidgetFormInputCheckbox(),
      'scheduled_deadline'       => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id'         => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'proj_resource_type_id'    => new sfValidatorPropelChoice(array('model' => 'ProjResourceType', 'column' => 'id', 'required' => false)),
      'description'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'charged_user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'quantity_estimated'       => new sfValidatorNumber(array('required' => false)),
      'quantity_approved'        => new sfValidatorNumber(array('required' => false)),
      'amount_estimated'         => new sfValidatorNumber(array('required' => false)),
      'amount_funded_externally' => new sfValidatorNumber(array('required' => false)),
      'financing_notes'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'quantity_final'           => new sfValidatorNumber(array('required' => false)),
      'standard_cost'            => new sfValidatorNumber(array('required' => false)),
      'is_monetary'              => new sfValidatorBoolean(array('required' => false)),
      'scheduled_deadline'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_resource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResource';
  }


}
