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
    
    $this->reference='it';
    // we are sure that strings to be translated are placed here...
    
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
      if(substr($language, 0, 1)!='.' && $language!=$this->reference)
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
    
    $rfile=$this->dir . $this->reference . '/messages.xml';
    $lfile=$this->dir . $this->lang . '/messages.xml';
    $gt=$this->dir . $this->lang . '/translations.txt';  // google translations

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

    $lxml = new SimpleXmlElement($lfile, null, true);
    $rxml = new SimpleXmlElement($rfile, null, true);
    
    $lresult = $lxml->xpath('/xliff/file/body/trans-unit');
    $rresult = $rxml->xpath('/xliff/file/body/trans-unit');

    $this->units=array();
    
    $targets=array();
    
    foreach($rresult as $node)
    {
      $attributes=$node->attributes();
      $id=(int)$attributes['id'];
      
      $source=(string) $node->source;
      
      $this->units[$id]=array(
        'rsource'=>(string) $node->source,
        'lsource'=>'',
        'target'=>'',
        'machine'=>'',
        'matches'=>'',
        'warnings'=>array(),
        );
      }

    foreach($lresult as $node)
    {
      $warnings=array();
      
      $attributes=$node->attributes();
      $id=(int)$attributes['id'];
      
      $source=(string) $node->source;
      $target=(string) $node->target;

      if(!array_key_exists($target, $targets))
      {
        $targets[$target]=$id;
        Generic::logMessage('targets', 'added item '. $target . ' id=' . $id);
      }

      $matches=array();
      preg_match_all($this->regexp, $source, $matches);
      
      $newsource = preg_replace($this->regexp, '§', $source);
      
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
      else
      {
        $machine=null;
      }
      
      if(array_key_exists($id, $this->units))
      {
        if($source!=$this->units[$id]['rsource'])
        {
          $warnings[]='sources do not match';
        }
        $this->units[$id]['lsource']=(string) $node->source;
        $this->units[$id]['target']=(string) $node->target;
        $this->units[$id]['newsource']=$newsource;
        $this->units[$id]['warnings']=$warnings;
        $this->units[$id]['matches']=implode(', ', $matches[0]);
        $this->units[$id]['machine']=$machine;
         
      }
      else
      {
        $warnings[]=sprintf('unit %d not found in the reference', $id);
        if(array_key_exists($target, $targets))
        {
          $warnings[]='link:'. $targets[$target];
        }

        $this->units[]=array(
          'lsource'=>(string) $node->source,
          'rsource'=>'',
          'target'=>(string) $node->target,
          'newsource'=>$newsource,
          'warnings'=>$warnings,
          'matches'=>implode(', ', $matches[0]),
          'machine'=>$machine,
          );
      }
    }      
  }

  public function executeReference(sfWebRequest $request)
  {
    
    $this->lang=$this->reference;
    
    $file=$this->dir . $this->lang . '/messages.xml';

    $xml = new SimpleXmlElement($file, null, true);
    
    $result = $xml->xpath('/xliff/file/body/trans-unit');

    $ids=array();
    $strings=array();
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
      else
      {
        $ids[]=$id;
      }
      
      if(in_array($source, $strings))
      {
        $warnings[]="source duplicated";
      }
      else
      {
        $strings[]=$source;
      }
      
      $this->units[]=array(
        'source'=>(string) $node->source,
        'target'=>(string) $node->target,
        'newsource'=>$newsource,
        'id'=>$id,
        'warnings'=>implode(', ', $warnings),
        'matches'=>implode(', ', $matches[0]),
        );
      }
    }
  
}
