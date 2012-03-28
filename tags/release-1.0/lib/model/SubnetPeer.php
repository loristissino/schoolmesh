<?php

/**
 * SubnetPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SubnetPeer extends BaseSubnetPeer
{
  public static function findSubnetFromIP($Subnets, $IPAddress)
  {
    foreach($Subnets as $Subnet)
    {
      if (Generic::netMatch($Subnet->getIpCidr(), $IPAddress))
      {
        return $Subnet;
      }
    }
    return null;
  }
}
