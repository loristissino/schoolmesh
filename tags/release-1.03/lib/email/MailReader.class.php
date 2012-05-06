<?php

class MailReader
{
  public function __construct($application, $env)
  {
    $this->_info=$this->_getConfig($application, $env);
    print_r($this->_info);
    $this->_imapserver=$this->_info['imapserver'];
    $this->_imapport=$this->_info['imapport'];
    $this->_imapuser=$this->_info['username'];
    $this->_imappassword=$this->_info['password'];
    $this->_encryption=$this->_info['encryption'];
    $this->_isopen=false;
    $this->_cache=array();
  }
  
  private function _getMboxName()
  {
    $cs='{' . $this->_imapserver . ':' . $this->_imapport . '/imap';
    if($this->_encryption=='ssl')
    {
      $cs.='/ssl';
    }
    $cs.='}INBOX';
    return $cs;
  }
  
  public function openConnection()
  {
    if(!$this->mbox=imap_open($this->_getMboxName(), $this->_imapuser, $this->_imappassword))
    {
      $this->_isopen=false;
    }
    else
    {
      $this->_isopen=true;
    }
    return $this;
  }
  
  public function isOpen()
  {
    return $this->_isopen;
  }
  
  public function getHeaders()
  {
    return imap_headers($this->mbox);
  }
  
  public function getStatus()
  {
    $status=imap_status($this->mbox, $this->_getMboxName(), SA_ALL);
    return $status;
  }
  
  public function getNumMessages()
  {
    $status=$this->getStatus();
    return $status->messages;
  }
  
  public function deleteMessage($msg_number)
  {
    imap_delete($this->mbox, $msg_number);
    return $this;
  }
  
  public function expunge()
  {
    imap_expunge($this->mbox);
    return $this;
  }
  
  public function getHeaderInfo($msg_number)
  {
    if(!array_key_exists($msg_number, $this->_cache))
    {
      $this->_cache[$msg_number]['headerinfo']=imap_headerinfo($this->mbox, $msg_number);
    }
    return $this->_cache[$msg_number]['headerinfo'];
  }
  
  public function getBody($msg_number)
  {
    return imap_body($this->mbox, $msg_number);
  }
  
  public function getSubject($msg_number)
  {
    $headerInfo=$this->getHeaderInfo($msg_number);
    return $headerInfo->subject;
  }
  
  public function isNew($msg_number)
  {
    $headerInfo=$this->getHeaderInfo($msg_number);
    return $headerInfo->Recent=='N' or $headerInfo->Unseen=='U';
  }
  
  public function getFromaddress($msg_number)
  {
    $headerInfo=$this->getHeaderInfo($msg_number);
    return $headerInfo->fromaddress;
  }
  
  public function getFrom($msg_number, $complete=true)
  {
    $headerInfo=$this->getHeaderInfo($msg_number);
    $from=$headerInfo->from;  // this returns an array, we'll use the first item
    if($complete)
    {
      return array($from[0]->mailbox . '@' . $from[0]->host => (property_exists($from[0], 'personal') ? $from[0]->personal : ''));
    }
    else
    {
      return $from[0]->mailbox . '@' . $from[0]->host;
    }
  }

  public function markAsSeen($msg_number)
  {
    imap_setflag_full($this->mbox, $msg_number, '\Seen');
    return $this;
  }

  public function closeConnection()
  {
    imap_close($this->mbox);
    $this->_isopen=false;
    return $this;
  }
  
  public function getErrors()
  {
    return imap_last_error();
  }
  
  
  private function _getConfig($application, $env)
  {
    $config=sfYaml::load(sfConfig::get('app_config_base_dir') . '/apps/' . $application . '/config/factories.yml');
    if(@$config[$env]['mailer']['param']['transport']['param'])
    {
      return $config[$env]['mailer']['param']['transport']['param'];
    }
    else
    {
      return $config['default']['mailer']['param']['transport']['param'];
    }
    
  }
  
  
  
}