<?php

/**
 * Schoolproject filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSchoolprojectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'proj_category_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'year_id'          => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'            => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'hours_approved'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'proj_category_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjCategory', 'column' => 'id')),
      'year_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'hours_approved'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('schoolproject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolproject';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'proj_category_id' => 'ForeignKey',
      'year_id'          => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'title'            => 'Text',
      'description'      => 'Text',
      'hours_approved'   => 'Number',
    );
  }
}
