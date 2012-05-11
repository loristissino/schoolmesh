<?php
class AppointmentExportForm extends BaseForm
  {
    public function configure()
    {
      $formats=sfConfig::get('app_opendocument_formats');
      $editions=array('U'=>'Unabridged document', 'A'=>'Abridged document');
			
      $this->setWidgets(array(
        'doctype' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $formats))),
        'edition' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $editions))),
      ));
      
      $this['doctype']->getWidget()->setLabel('Format');
		}
	}
