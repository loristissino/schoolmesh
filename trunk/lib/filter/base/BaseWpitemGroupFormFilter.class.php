<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WpitemGroup filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWpitemGroupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'wpitem_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpitemType', 'add_empty' => true)),
      'wpmodule_id'    => new sfWidgetFormPropelChoice(array('model' => 'Wpmodule', 'add_empty' => true)),
      'max_rank'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'wpitem_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WpitemType', 'column' => 'id')),
      'wpmodule_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Wpmodule', 'column' => 'id')),
      'max_rank'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wpitem_group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemGroup';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'wpitem_type_id' => 'ForeignKey',
      'wpmodule_id'    => 'ForeignKey',
      'max_rank'       => 'Number',
    );
  }
}
