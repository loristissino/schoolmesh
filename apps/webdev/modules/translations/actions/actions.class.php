<?php

/**
 * translations actions.
 *
 * @package    schoolmesh
 * @subpackage translations
 * @author     Loris Tissino <loris.tissino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class translationsActions extends sfActions
{
  
  public function preExecute()
  {
    $this->dir='/var/schoolmesh/apps/frontend/i18n/';
    // hardcoded, we need it only in this development environment...
    
    $this->regexp='/%[^%]*%/';
  }
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->languages=array();
    $languages=scandir($this->dir);
    foreach($languages as $language)
    {
      if(substr($language, 0, 1)!='.')
      {
        $this->languages[]=$language;
      }
    }
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->setTemplate($request->getParameter('template', 'show'));
    if($request->getParameter('template')=='xliff')
    {
      $response = $this->getContext()->getResponse();
      $response->setHttpHeader('Content-Type', 'text/xml');
      $response->setHttpHeader('Content-Disposition', 'attachment; filename="messages-generated.xliff"');
      $this->setLayout(false);
    }
    
    $this->lang=$request->getParameter('lang');
    
    $file=$this->dir . $this->lang . '/messages.xml';
    
    $gt=$this->dir . $this->lang . '/translations.txt';

    $gtexists=false;
    
    if(file_exists($gt))
    {
      $gtexists=true;
      $translations=array();

      foreach(file($gt) as $line)
      {
        $sp=strpos($line, ' ');
        $id=substr($line, 0, $sp);
        $text=chop(substr($line, $sp+1));
        $translations[$id]=$text;
      }
    }

    $xml = new SimpleXmlElement($file, null, true);

    $result = $xml->xpath('/xliff/file/body/trans-unit');

//    $output=fopen('/tmp/output.txt', 'w');

    

    $ids=array();
    $this->units=array();
    
    
    
    foreach($result as $node)
    {
      $warnings=array();
      
      $attributes=$node->attributes();
      $id=(int)$attributes['id'];
      
      $source=(string) $node->source;
      $target=(string) $node->target;

      $matches=array();
      preg_match_all($this->regexp, $source, $matches);
      
      $newsource = preg_replace($this->regexp, '§', $source);

      if(in_array($id, $ids))
      {
        $warnings[]="id duplicated";
      }
      $ids[]=$id;
      
      if($gtexists)
      {
        $machine=isset($translations[$id])?$translations[$id]: '';
        if($machine)
        {
          if(sizeof($matches[0]))
          {
            foreach($matches[0] as $match)
            {
              
              $machine=preg_replace('/§/', $match, $machine, 1);
            }
          }
        }
        
      }
      
      $this->units[]=array(
        'source'=>(string) $node->source,
        'target'=>(string) $node->target,
        'newsource'=>$newsource,
        'id'=>$id,
        'warnings'=>implode(', ', $warnings),
        'matches'=>implode(', ', $matches[0]),
        'machine'=>$machine,
        );
      
      }
        
        
    }
  
  
}
