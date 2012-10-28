<?php

/**
 * Docrevision form base class.
 *
 * @method Docrevision getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseDocrevisionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'document_id'             => new sfWidgetFormPropelChoice(array('model' => 'Document', 'add_empty' => false)),
      'revision_number'         => new sfWidgetFormInputText(),
      'revisioned_at'           => new sfWidgetFormDateTime(),
      'uploader_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'revision_grounds'        => new sfWidgetFormTextarea(),
      'content'                 => new sfWidgetFormTextarea(),
      'content_type'            => new sfWidgetFormInputText(),
      'source_attachment_id'    => new sfWidgetFormPropelChoice(array('model' => 'AttachmentFile', 'add_empty' => true)),
      'published_attachment_id' => new sfWidgetFormPropelChoice(array('model' => 'AttachmentFile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'document_id'             => new sfValidatorPropelChoice(array('model' => 'Document', 'column' => 'id')),
      'revision_number'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'revisioned_at'           => new sfValidatorDateTime(array('required' => false)),
      'uploader_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'revision_grounds'        => new sfValidatorString(),
      'content'                 => new sfValidatorString(array('required' => false)),
      'content_type'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'source_attachment_id'    => new sfValidatorPropelChoice(array('model' => 'AttachmentFile', 'column' => 'id', 'required' => false)),
      'published_attachment_id' => new sfValidatorPropelChoice(array('model' => 'AttachmentFile', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('docrevision[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Docrevision';
  }


}
