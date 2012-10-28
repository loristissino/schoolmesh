<?php

/**
 * Docrevision filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseDocrevisionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'             => new sfWidgetFormPropelChoice(array('model' => 'Document', 'add_empty' => true)),
      'revision_number'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'revisioned_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'uploader_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'revision_grounds'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'                 => new sfWidgetFormFilterInput(),
      'content_type'            => new sfWidgetFormFilterInput(),
      'source_attachment_id'    => new sfWidgetFormPropelChoice(array('model' => 'AttachmentFile', 'add_empty' => true)),
      'published_attachment_id' => new sfWidgetFormPropelChoice(array('model' => 'AttachmentFile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'document_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Document', 'column' => 'id')),
      'revision_number'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'revisioned_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'uploader_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'revision_grounds'        => new sfValidatorPass(array('required' => false)),
      'content'                 => new sfValidatorPass(array('required' => false)),
      'content_type'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'source_attachment_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AttachmentFile', 'column' => 'id')),
      'published_attachment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AttachmentFile', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('docrevision_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Docrevision';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'document_id'             => 'ForeignKey',
      'revision_number'         => 'Number',
      'revisioned_at'           => 'Date',
      'uploader_id'             => 'ForeignKey',
      'revision_grounds'        => 'Text',
      'content'                 => 'Text',
      'content_type'            => 'Number',
      'source_attachment_id'    => 'ForeignKey',
      'published_attachment_id' => 'ForeignKey',
    );
  }
}
