<?php

/**
 * Group form base class.
 *
 * @package    form
 * @subpackage group
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'person_group_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Person')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Group', 'column' => 'id', 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'person_group_list' => new sfValidatorPropelChoiceMany(array('model' => 'Person', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Group';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['person_group_list']))
    {
      $values = array();
      foreach ($this->object->getPersonGroups() as $obj)
      {
        $values[] = $obj->getGroupId();
      }

      $this->setDefault('person_group_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePersonGroupList($con);
  }

  public function savePersonGroupList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['person_group_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PersonGroupPeer::PERSON_ID, $this->object->getPrimaryKey());
    PersonGroupPeer::doDelete($c, $con);

    $values = $this->getValue('person_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PersonGroup();
        $obj->setPersonId($this->object->getPrimaryKey());
        $obj->setGroupId($value);
        $obj->save();
      }
    }
  }

}
