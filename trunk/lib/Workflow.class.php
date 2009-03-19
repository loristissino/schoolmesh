<?php 
class Workflow
{
	
	static public function getWpStatusDescriptions()
	{
	
	$descriptions=Array
		(
			0=>sfContext::getInstance()->getI18N()->__("draft"),
			1=>sfContext::getInstance()->getI18N()->__("submitted as workplan"),
			2=>sfContext::getInstance()->getI18N()->__("approved as workplan"),
			3=>sfContext::getInstance()->getI18N()->__("submitted as final report"),
			4=>sfContext::getInstance()->getI18N()->__("approved as final report")
		);
		
	return $descriptions;
	}
	
	static public function getWpViewActions()
	{
	
	$descriptions=Array
		(
			0=>sfContext::getInstance()->getI18N()->__("edit"),
			1=>sfContext::getInstance()->getI18N()->__("show"),
			2=>sfContext::getInstance()->getI18N()->__("edit as final report"),
			3=>sfContext::getInstance()->getI18N()->__("show"),
			4=>sfContext::getInstance()->getI18N()->__("show")
		);
		
	return $descriptions;
	}
	
	static public function getWpSubmitActions()
	{
	
	$descriptions=Array
		(
			0=>sfContext::getInstance()->getI18N()->__("Submit this workplan for approval"),
			1=>"",
			2=>sfContext::getInstance()->getI18N()->__("Submit this final report for approval"),
			3=>"",
			4=>""
		);
		
	return $descriptions;
	}

};
