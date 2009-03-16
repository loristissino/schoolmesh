<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                    => new sfWidgetFormInputHidden(),
      'first_name'                 => new sfWidgetFormInput(),
      'middle_name'                => new sfWidgetFormInput(),
      'last_name'                  => new sfWidgetFormInput(),
      'role_id'                    => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'sex'                        => new sfWidgetFormInput(),
      'email'                      => new sfWidgetFormInput(),
      'birthdate'                  => new sfWidgetFormDate(),
      'birthplace'                 => new sfWidgetFormInput(),
      'import_code'                => new sfWidgetFormInput(),
      'disk_set_soft_blocks_quota' => new sfWidgetFormInput(),
      'disk_set_hard_blocks_quota' => new sfWidgetFormInput(),
      'disk_set_soft_files_quota'  => new sfWidgetFormInput(),
      'disk_set_hard_files_quota'  => new sfWidgetFormInput(),
      'disk_used_blocks'           => new sfWidgetFormInput(),
      'disk_used_files'            => new sfWidgetFormInput(),
      'disk_updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'                    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'first_name'                 => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'middle_name'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'last_name'                  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'role_id'                    => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'sex'                        => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'email'                      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'birthdate'                  => new sfValidatorDate(array('required' => false)),
      'birthplace'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'import_code'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'disk_set_soft_blocks_quota' => new sfValidatorInteger(array('required' => false)),
      'disk_set_hard_blocks_quota' => new sfValidatorInteger(array('required' => false)),
      'disk_set_soft_files_quota'  => new sfValidatorInteger(array('required' => false)),
      'disk_set_hard_files_quota'  => new sfValidatorInteger(array('required' => false)),
      'disk_used_blocks'           => new sfValidatorInteger(array('required' => false)),
      'disk_used_files'            => new sfValidatorInteger(array('required' => false)),
      'disk_updated_at'            => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}
