<?php

/**
 * SchoolclassDocument form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class SchoolclassDocumentForm extends BaseForm
{
  
  public function configure()
  {
    
    $formats=sfConfig::get('app_opendocument_formats');
    
    $c=new Criteria();
    if(isset($this->options['AppointmentType']))
    {
      $this->AppointmentType=$this->options['AppointmentType'];
      $c->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $this->AppointmentType->getId());
    }

    if(isset($this->options['confidential']))
    {
      $this->confidential=$this->options['confidential'];
      if(!$this->confidential)
      {
        $c->add(WpinfoTypePeer::IS_CONFIDENTIAL, false);
      }
    }
    
    $this->setWidgets(array(
      'wpinfotypes' => new sfWidgetFormPropelChoice(array('model'=>'WpinfoType', 'multiple'=>true, 'peer_method'=>'doSelect', 'criteria'=>$c)),
      'doctype' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $formats))),
    ));
    
    $this['wpinfotypes']->getWidget()->setLabel('Fields');
    $this['wpinfotypes']->getWidget()->setAttributes(array('size'=>$this->AppointmentType->countWpinfoTypes($c)));
    
    $this['doctype']->getWidget()->setLabel('Format');
    
    $this->widgetSchema->setNameFormat('info[%s]');
    
  }

  
}
