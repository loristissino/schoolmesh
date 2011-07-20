<?php

/**
 * AttachmentFile form base class.
 *
 * @method AttachmentFile getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseAttachmentFileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'base_table'          => new sfWidgetFormInputText(),
      'base_id'             => new sfWidgetFormInputText(),
      'internet_media_type' => new sfWidgetFormInputText(),
      'original_file_name'  => new sfWidgetFormInputText(),
      'uniqid'              => new sfWidgetFormInputText(),
      'file_size'           => new sfWidgetFormInputText(),
      'is_public'           => new sfWidgetFormInputCheckbox(),
      'md5sum'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'AttachmentFile', 'column' => 'id', 'required' => false)),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'base_table'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'base_id'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'internet_media_type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'original_file_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'uniqid'              => new sfValidatorString(array('max_length' => 50)),
      'file_size'           => new sfValidatorInteger(array('min' => -9.2233720368548E+18, 'max' => 9.2233720368548E+18, 'required' => false)),
      'is_public'           => new sfValidatorBoolean(array('required' => false)),
      'md5sum'              => new sfValidatorString(array('max_length' => 32, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'AttachmentFile', 'column' => array('uniqid'))),
        new sfValidatorPropelUnique(array('model' => 'AttachmentFile', 'column' => array('base_table', 'base_id', 'md5sum'))),
      ))
    );

    $this->widgetSchema->setNameFormat('attachment_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttachmentFile';
  }


}
