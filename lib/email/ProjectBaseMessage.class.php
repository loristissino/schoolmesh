<?php

class ProjectBaseMessage extends Swift_Message
{
	
  private
    $_template_directory,
    $_tagline
    ;
  
  public function __construct($from=Array())
  {
    parent::__construct();
	
    if (! is_array($from))
    {
      throw new Exception ('From field must be an array');
    }
    
    if (sizeof($from)==0)
    {
      $appbot_address=sfConfig::get('app_mail_bot_address');
      if ($appbot_address=='')
      {
        throw new Exception ('Application bot address not specified in your app.yml file');
      }
      
      $from[$appbot_address]=sfConfig::get('app_mail_bot_name', 'SchoolMesh App Bot');
    }
   
    $this
    ->setFrom($from)
    ->setTemplateDirectory(sfConfig::get('app_mail_template_directory'))
    ;
    
    $backup=sfConfig::get('app_mail_backup_address','');
    
    if($backup!='')
    {
      $this->addBcc($backup);
    }
	
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
  
  public function getToName()
  {
    $to=$this->getTo();
    return current($to);
  }
  
  public function getToAddress()
  {
    $to=array_keys($this->getTo());
    return $to[0];
  }
	
  public function setTagline($value)
  {
    if (!$value)
    {
      $value = <<<EOF
--

Email sent by SchoolMesh Bot
EOF
      ;
    }
    
    $this->_tagline=$value;
    return $this;
  }
  
  public function getTagline()
  {
    return $this->_tagline;
  }
  
  public function addStandardTagline()
	{
    $this->setBody($this->getBody() . "\n" . $this->getTagline());
    return $this;
  } 

  public function addSchoolMeshHeader(sfContext $sfContext=null)
	{
    if ($sfContext)
    {
      $this->getHeaders()->addTextHeader('X-SchooMesh-RealSender', $sfContext->getUser()->getProfile()->getUsername());
    }
    
    return $this;
  } 
  

  public function makeReplacements($replacements)
  {
    foreach($replacements as $key=>$value)
    {
      $this->setBody(str_replace($key, $value, $this->getBody()));
      $this->setSubject(str_replace($key, $value, $this->getSubject()));
    }
    
    return $this;
    
  }
  
  public function parseTemplate($template, sfGuardUserProfile $addressee, sfContext $sfContext=null)
  {
    $filename=$this->getTemplateDirectory() . '/' . $template;
    if (!is_readable($filename))
    {
      throw new Exception ('File not readable: ' . $filename);
    }
  
    $config=sfYaml::load($filename);
        
    $subject=$config['message']['subject'];
    
    if ($config['message']['salutation'])
    {
      $body = $addressee->getSalutation($sfContext) . "\n";
    } 
    else
    {
      $body = '';
    }
  
    $body .= $config['message']['body'];

    $this
    ->setSubject($subject)
    ->setBody($body)
    ;


    $this->setTagline($config['message']['tagline']);

    return $this;
  
    
    
  }
  


}