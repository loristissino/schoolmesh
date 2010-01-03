<?php

/**
 * Suggestion filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSuggestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shortcut' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rank'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'shortcut' => new sfValidatorPass(array('required' => false)),
      'content'  => new sfValidatorPass(array('required' => false)),
      'rank'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'       => 'Number',
      'shortcut' => 'Text',
      'content'  => 'Text',
      'rank'     => 'Number',
    );
  }
}
