<?php

/**
 * WpmoduleItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWpmoduleItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'wpitem_group_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemGroup', 'add_empty' => true)),
      'rank'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'         => new sfWidgetFormFilterInput(),
      'evaluation'      => new sfWidgetFormFilterInput(),
      'is_editable'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'wpitem_group_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WpitemGroup', 'column' => 'id')),
      'rank'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'         => new sfValidatorPass(array('required' => false)),
      'evaluation'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_editable'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('wpmodule_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpmoduleItem';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'wpitem_group_id' => 'ForeignKey',
      'rank'            => 'Number',
      'content'         => 'Text',
      'evaluation'      => 'Number',
      'is_editable'     => 'Boolean',
    );
  }
}
