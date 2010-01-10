<?php

/**
 * RecuperationHint filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseRecuperationHintFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'content' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rank'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'content' => new sfValidatorPass(array('required' => false)),
      'rank'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'      => 'Number',
      'user_id' => 'ForeignKey',
      'content' => 'Text',
      'rank'    => 'Number',
    );
  }
}
