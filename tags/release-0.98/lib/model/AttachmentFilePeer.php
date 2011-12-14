<?php

/**
 * AttachmentFile class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class AttachmentFilePeer extends BaseAttachmentFilePeer {

  public static function getBaseTableId($classname)
  {
    
    switch($classname)
    {
      case 'ProjDeadline':
        return 1;
      case 'Schoolproject':
        return 2;
      case 'Appointment':
        return 3;
      default:
        return 0;
    }
  }
  
  public static function getPrefix($classname)
  {
    return strtolower($classname);
  }

  public static function retrieveByClassAndId($classname, $id)
  {
    $c=new Criteria();
    $c->add(self::BASE_TABLE, self::getBaseTableId($classname));
    $c->add(self::BASE_ID, $id);
    return self::doSelect($c);
  }


  public static function addAttachment($con, $object, $prefix, $user_id, sfValidatedFile $file=null, $result=array(), $public=false)
  {
    
    return self::addAttachmentRoughly(
      $con, 
      $object->getId(), 
      AttachmentFilePeer::getBaseTableId(get_class($object)), 
      $prefix,
      $user_id,
      $file,
      $object,
      $result,
      $public
      );
    
  }
  
  public static function addAttachmentRoughly($con, $object_id, $class_id, $prefix, $user_id, sfValidatedFile $file=null, $object=null, $result=array(), $public=false)

  {
    if(sizeof($result)==0)
    {
      $result['result']='notice';
      $result['message']='Attachment successfully saved.';
    }
    
    $con->beginTransaction();
    
    if($object) // when called in task, we don't get it
    {
      $object->save($con);
    }

    if(!is_null($file))
    {
      $attachment=new AttachmentFile();
      
      $attachment
      ->setUserId($user_id)
      ->setBaseTable($class_id)
      ->setBaseId($object_id)
      ->setIsPublic($public)
      ;
      
      if ($attachment->setFile($prefix, $file))
      {
        try
        {
          $attachment->save($con);
          $con->commit();
      
        }
        catch (Exception $e)
        {
          $con->rollBack();
          $result['result']='error';
          $result['message']='This file was already uploaded.';
        }
      }
      else
      {
        echo "error in setting file\n";
        $con->rollBack();
        $result['result']='error';
        $result['message']='Could not save the uploaded file.';
      }
        
    }
    else
    {
      $con->commit();
    }
    
    return $result;
    
  }


} // AttachmentFilePeer
