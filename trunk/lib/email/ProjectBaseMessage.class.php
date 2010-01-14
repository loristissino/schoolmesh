<?php

class ProjectBaseMessage extends Swift_Message
{
	
  private $_template_directory;
  
  public function __construct()
  {
    parent::__construct();
 
	$this
      ->setFrom(array(sfConfig::get('app_mail_bot') => 'SchoolMesh App Bot'))
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