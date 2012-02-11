<?php

/**
 * StudentSituation filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseStudentSituationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term_id'          => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => true)),
      'wpmodule_item_id' => new sfWidgetFormPropelChoice(array('model' => 'WpmoduleItem', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'evaluation'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'term_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Term', 'column' => 'id')),
      'wpmodule_item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WpmoduleItem', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'evaluation'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('student_situation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSituation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'term_id'          => 'ForeignKey',
      'wpmodule_item_id' => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'evaluation'       => 'Number',
    );
  }
}
