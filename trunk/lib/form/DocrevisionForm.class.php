<?php

/**
 * Docrevision form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class DocrevisionForm extends BaseDocrevisionForm
{
  public function configure()
  {
    
    $this->content_types = array(1=>'---', 2=>'text/plain', 3=>'text/html', 4=>'text/x-web-markdown');
    
    unset(
      $this['uploader_id'],
      $this['source_attachment_id'],
      $this['published_attachment_id']
    );


    $this->widgetSchema['revisioned_at'] = new sfWidgetFormI18nDateTime(array('culture'=>'it')) ;
    $this->widgetSchema['document_id'] = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
    
    $this->widgetSchema['revision_grounds']->setAttributes(array('cols'=>40, 'rows'=>5)); // = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
    $this->widgetSchema['content']->setAttributes(array('cols'=>60, 'rows'=>10)); // = new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true));
    
    $this->widgetSchema['content_type'] = new sfWidgetFormSelect(array('choices'=>$this->content_types));
    
    $this->widgetSchema['source_attachment'] = new sfWidgetFormInputFile();
    $this->widgetSchema['published_attachment'] = new sfWidgetFormInputFile();
    $this->validatorSchema['source_attachment'] = new sfValidatorFile(array('required'=>false));
    $this->validatorSchema['published_attachment'] = new sfValidatorFile(array('required'=>false));
    
    $this->validatorSchema['content_type'] = new sfValidatorChoice(array('choices' => array_keys($this->content_types), 'multiple'=>false));
    
  }
}
