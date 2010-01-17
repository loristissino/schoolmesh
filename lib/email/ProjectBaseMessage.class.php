<?php

class ProjectBaseMessage extends Swift_Message
{
	
  private $_template_directory;
  
  public function __construct($from=Array())
  {
    parent::__construct();
	
	if (! is_array($from))
	{
		throw new Exception ('From field must be an array');
	}
	
	if (sizeof($from)==0)
	{
		$from[sfConfig::get('app_mail_bot')]='SchoolMesh App Bot';
	}
 
	$this
      ->setFrom($from)
	  ->setTemplateDirectory(sfConfig::get('app_mail_template_directory'))
	;  
	
  }

  public function setTemplateDirectory($value)
	{
		$this->_template_directory = sfConfig::get('app_mail_template_directory');
		return $this;
	}
  public function getTemplateDirectory()
	{
		return $this->_template_directory;
	}
	
  public function addStandardTagline()
	{
      $tagline = <<<EOF
--

Email sent by SchoolMesh Bot
EOF
    ;
	$this->setBody($this->getBody() . $tagline);
	return $this;
}


}