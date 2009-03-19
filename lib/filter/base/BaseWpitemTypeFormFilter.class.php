<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WpitemType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWpitemTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                      => new sfWidgetFormFilterInput(),
      'description'                => new sfWidgetFormFilterInput(),
      'rank'                       => new sfWidgetFormFilterInput(),
      'status'                     => new sfWidgetFormFilterInput(),
      'evaluation_min'             => new sfWidgetFormFilterInput(),
      'evaluation_max'             => new sfWidgetFormFilterInput(),
      'evaluation_min_description' => new sfWidgetFormFilterInput(),
      'evaluation_max_description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'                      => new sfValidatorPass(array('required' => false)),
      'description'                => new sfValidatorPass(array('required' => false)),
      'rank'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_min'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_min_description' => new sfValidatorPass(array('required' => false)),
      'evaluation_max_description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpitem_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemType';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'title'                      => 'Text',
      'description'                => 'Text',
      'rank'                       => 'Number',
      'status'                     => 'Number',
      'evaluation_min'             => 'Number',
      'evaluation_max'             => 'Number',
      'evaluation_min_description' => 'Text',
      'evaluation_max_description' => 'Text',
    );
  }
}
