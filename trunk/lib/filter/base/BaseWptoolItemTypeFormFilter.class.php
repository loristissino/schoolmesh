<?php

/**
 * WptoolItemType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWptoolItemTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'  => new sfWidgetFormFilterInput(),
      'rank'         => new sfWidgetFormFilterInput(),
      'state'        => new sfWidgetFormFilterInput(),
      'min_selected' => new sfWidgetFormFilterInput(),
      'max_selected' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'  => new sfValidatorPass(array('required' => false)),
      'rank'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_selected' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_selected' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wptool_item_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItemType';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'description'  => 'Text',
      'rank'         => 'Number',
      'state'        => 'Number',
      'min_selected' => 'Number',
      'max_selected' => 'Number',
    );
  }
}
