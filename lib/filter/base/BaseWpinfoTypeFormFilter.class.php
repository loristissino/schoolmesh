<?php

/**
 * WpinfoType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWpinfoTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'       => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'rank'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'       => new sfWidgetFormFilterInput(),
      'template'    => new sfWidgetFormFilterInput(),
      'example'     => new sfWidgetFormFilterInput(),
      'is_required' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_reserved' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'title'       => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'rank'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'template'    => new sfValidatorPass(array('required' => false)),
      'example'     => new sfValidatorPass(array('required' => false)),
      'is_required' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_reserved' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpinfoType';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title'       => 'Text',
      'description' => 'Text',
      'rank'        => 'Number',
      'state'       => 'Number',
      'template'    => 'Text',
      'example'     => 'Text',
      'is_required' => 'Boolean',
      'is_reserved' => 'Boolean',
    );
  }
}
