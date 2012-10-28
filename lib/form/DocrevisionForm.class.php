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
    
    unset(
      $this['uploader_id'],
      $this['source_attachment_id'],
      $this['published_attachment_id']
    );
    
    $this->widgetSchema['source_attachment'] = new sfWidgetFormInputFile();
    $this->widgetSchema['published_attachment'] = new sfWidgetFormInputFile();
    $this->validatorSchema['source_attachment'] = new sfValidatorFile(array('required'=>false));
    $this->validatorSchema['published_attachment'] = new sfValidatorFile(array('required'=>false));
    
    
  }
}
