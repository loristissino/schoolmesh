<?php

/**
 * Document filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseDocumentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'doctype_id'       => new sfWidgetFormPropelChoice(array('model' => 'Doctype', 'add_empty' => true)),
      'code'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_form'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'docrevision_id'   => new sfWidgetFormPropelChoice(array('model' => 'Docrevision', 'add_empty' => true)),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_deprecated'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notes'            => new sfWidgetFormFilterInput(),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'doctype_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Doctype', 'column' => 'id')),
      'code'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'is_form'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'docrevision_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Docrevision', 'column' => 'id')),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_deprecated'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notes'            => new sfValidatorPass(array('required' => false)),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SyllabusItem', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('document_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'doctype_id'       => 'ForeignKey',
      'code'             => 'Text',
      'title'            => 'Text',
      'is_form'          => 'Boolean',
      'docrevision_id'   => 'ForeignKey',
      'is_active'        => 'Boolean',
      'is_deprecated'    => 'Boolean',
      'notes'            => 'Text',
      'syllabus_item_id' => 'ForeignKey',
    );
  }
}
