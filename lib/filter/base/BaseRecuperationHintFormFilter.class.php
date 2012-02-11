<?php

/**
 * RecuperationHint filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseRecuperationHintFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'content'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_selectable' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rank'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'content'       => new sfValidatorPass(array('required' => false)),
      'is_selectable' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rank'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('recuperation_hint_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecuperationHint';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'user_id'       => 'ForeignKey',
      'content'       => 'Text',
      'is_selectable' => 'Boolean',
      'rank'          => 'Number',
    );
  }
}
