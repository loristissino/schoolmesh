<?php

/**
 * Suggestion filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSuggestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shortcut'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_selectable' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rank'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'shortcut'      => new sfValidatorPass(array('required' => false)),
      'content'       => new sfValidatorPass(array('required' => false)),
      'is_selectable' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rank'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('suggestion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'shortcut'      => 'Text',
      'content'       => 'Text',
      'is_selectable' => 'Boolean',
      'rank'          => 'Number',
    );
  }
}
