<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WptoolItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWptoolItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'         => new sfWidgetFormFilterInput(),
      'wptool_item_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItemType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'description'         => new sfValidatorPass(array('required' => false)),
      'wptool_item_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WptoolItemType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('wptool_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItem';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'description'         => 'Text',
      'wptool_item_type_id' => 'ForeignKey',
    );
  }
}
