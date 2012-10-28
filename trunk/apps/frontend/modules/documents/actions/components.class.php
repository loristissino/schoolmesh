<?php

class documentsComponents extends sfComponents
{
  public function executeDoctype()
  {
    $this->Documents=DocumentPeer::retrieveByDoctypeId($this->Doctype->getId());
  }
  
  public function executeRevisions()
  {
    $this->Docrevisions=$this->Document->getDocrevisions();
  }

}
