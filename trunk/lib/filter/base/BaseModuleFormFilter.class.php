<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Module filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseModuleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shortcut'   => new sfWidgetFormFilterInput(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'      => new sfWidgetFormFilterInput(),
      'period'     => new sfWidgetFormFilterInput(),
      'is_public'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'locked'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'shortcut'   => new sfValidatorPass(array('required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'      => new sfValidatorPass(array('required' => false)),
      'period'     => new sfValidatorPass(array('required' => false)),
      'is_public'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'locked'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('module_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Module';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'shortcut'   => 'Text',
      'user_id'    => 'ForeignKey',
      'title'      => 'Text',
      'period'     => 'Text',
      'is_public'  => 'Boolean',
      'locked'     => 'Boolean',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
