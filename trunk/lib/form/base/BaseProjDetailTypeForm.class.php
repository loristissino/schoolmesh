<?php

/**
 * ProjDetailType form base class.
 *
 * @method ProjDetailType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjDetailTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                              => new sfWidgetFormInputHidden(),
      'proj_category_id'                => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'code'                            => new sfWidgetFormInputText(),
      'description'                     => new sfWidgetFormInputText(),
      'label'                           => new sfWidgetFormInputText(),
      'is_required'                     => new sfWidgetFormInputCheckbox(),
      'is_active'                       => new sfWidgetFormInputCheckbox(),
      'state_min'                       => new sfWidgetFormInputText(),
      'state_max'                       => new sfWidgetFormInputText(),
      'printed_in_submission_documents' => new sfWidgetFormInputCheckbox(),
      'printed_in_report_documents'     => new sfWidgetFormInputCheckbox(),
      'example'                         => new sfWidgetFormTextarea(),
      'missing_value_message'           => new sfWidgetFormInputText(),
      'filled_value_message'            => new sfWidgetFormInputText(),
      'cols'                            => new sfWidgetFormInputText(),
      'rows'                            => new sfWidgetFormInputText(),
      'rank'                            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'proj_category_id'                => new sfValidatorPropelChoice(array('model' => 'ProjCategory', 'column' => 'id', 'required' => false)),
      'code'                            => new sfValidatorString(array('max_length' => 30)),
      'description'                     => new sfValidatorString(array('max_length' => 255)),
      'label'                           => new sfValidatorString(array('max_length' => 100)),
      'is_required'                     => new sfValidatorBoolean(array('required' => false)),
      'is_active'                       => new sfValidatorBoolean(array('required' => false)),
      'state_min'                       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state_max'                       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'printed_in_submission_documents' => new sfValidatorBoolean(array('required' => false)),
      'printed_in_report_documents'     => new sfValidatorBoolean(array('required' => false)),
      'example'                         => new sfValidatorString(array('required' => false)),
      'missing_value_message'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'filled_value_message'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cols'                            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'rows'                            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'rank'                            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ProjDetailType', 'column' => array('code')))
    );

    $this->widgetSchema->setNameFormat('proj_detail_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDetailType';
  }


}
