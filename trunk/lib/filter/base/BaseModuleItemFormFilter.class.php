<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ModuleItem filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseModuleItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'item_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ItemType', 'add_empty' => true)),
      'module_id'    => new sfWidgetFormPropelChoice(array('model' => 'Module', 'add_empty' => true)),
      'position'     => new sfWidgetFormFilterInput(),
      'content'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'item_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ItemType', 'column' => 'id')),
      'module_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Module', 'column' => 'id')),
      'position'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('module_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ModuleItem';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'item_type_id' => 'ForeignKey',
      'module_id'    => 'ForeignKey',
      'position'     => 'Number',
      'content'      => 'Text',
    );
  }
}
