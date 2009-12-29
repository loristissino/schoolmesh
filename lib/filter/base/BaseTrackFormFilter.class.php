<?php

/**
 * Track filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTrackFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shortcut'    => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'shortcut'    => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('track_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Track';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'shortcut'    => 'Text',
      'description' => 'Text',
    );
  }
}
