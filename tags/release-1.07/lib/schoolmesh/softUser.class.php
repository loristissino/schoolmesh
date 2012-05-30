<?php

/**
 * softUser class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class softUser extends PluginsfGuardUser
{

    protected static function retrieve()
    {
        return LanlogPeer::retrieveByClientIP($_SERVER['REMOTE_ADDR']);
    }
/*
    public static function getSoftUsername()
    {
        $t=self::retrieve();
        if ($t)
            return $t->getsfGuardUser()->getUsername();
        else
            return null;
    }

    public static function getFullname()
    {
        $t=self::retrieve();
        if ($t)
            return $t->getsfGuardUser()->getProfile()->getFullname();
        else
            return null;
    }
*/

    public static function getSoftUser()
    {
        $t=self::retrieve();
        if ($t)
            return $t->getsfGuardUser();
        else
            return null;
        
    }

    public static function hasCredential($credential)
    {

        $t=self::retrieve();
        if ($t)
        {
            $p=$t->getsfGuardUser()->getAllPermissionNames();
            return in_array($credential, $p);
        }
        else
            return null;
        
    }
        


}
