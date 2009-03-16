<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Song filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseSongFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'  => new sfWidgetFormFilterInput(),
      'author' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'  => new sfValidatorPass(array('required' => false)),
      'author' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('song_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Song';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'title'  => 'Text',
      'author' => 'Text',
    );
  }
}
