<?php

/**
 * Consent filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseConsentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'               => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'informativecontent_id' => new sfWidgetFormPropelChoice(array('model' => 'Informativecontent', 'add_empty' => true)),
      'given_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'method'                => new sfWidgetFormFilterInput(),
      'notes'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'informativecontent_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Informativecontent', 'column' => 'id')),
      'given_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'method'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('consent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Consent';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'user_id'               => 'ForeignKey',
      'informativecontent_id' => 'ForeignKey',
      'given_at'              => 'Date',
      'method'                => 'Number',
      'notes'                 => 'Text',
    );
  }
}
