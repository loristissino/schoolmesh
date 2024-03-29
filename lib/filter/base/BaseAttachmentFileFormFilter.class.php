<?php

/**
 * AttachmentFile filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseAttachmentFileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'base_table'          => new sfWidgetFormFilterInput(),
      'base_id'             => new sfWidgetFormFilterInput(),
      'internet_media_type' => new sfWidgetFormFilterInput(),
      'original_file_name'  => new sfWidgetFormFilterInput(),
      'uniqid'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'file_size'           => new sfWidgetFormFilterInput(),
      'is_public'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'md5sum'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'base_table'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'base_id'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'internet_media_type' => new sfValidatorPass(array('required' => false)),
      'original_file_name'  => new sfValidatorPass(array('required' => false)),
      'uniqid'              => new sfValidatorPass(array('required' => false)),
      'file_size'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_public'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'md5sum'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attachment_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttachmentFile';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'user_id'             => 'ForeignKey',
      'base_table'          => 'Number',
      'base_id'             => 'Number',
      'internet_media_type' => 'Text',
      'original_file_name'  => 'Text',
      'uniqid'              => 'Text',
      'file_size'           => 'Number',
      'is_public'           => 'Boolean',
      'created_at'          => 'Date',
      'md5sum'              => 'Text',
    );
  }
}
