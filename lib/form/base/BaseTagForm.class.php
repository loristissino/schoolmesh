<?php

/**
 * Tag form base class.
 *
 * @package    form
 * @subpackage tag
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'article_tag_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Article')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Tag', 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'article_tag_list' => new sfValidatorPropelChoiceMany(array('model' => 'Article', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['article_tag_list']))
    {
      $values = array();
      foreach ($this->object->getArticleTags() as $obj)
      {
        $values[] = $obj->getArticleId();
      }

      $this->setDefault('article_tag_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveArticleTagList($con);
  }

  public function saveArticleTagList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['article_tag_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ArticleTagPeer::TAG_ID, $this->object->getPrimaryKey());
    ArticleTagPeer::doDelete($c, $con);

    $values = $this->getValue('article_tag_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ArticleTag();
        $obj->setTagId($this->object->getPrimaryKey());
        $obj->setArticleId($value);
        $obj->save();
      }
    }
  }

}
