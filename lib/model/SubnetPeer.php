<?php

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
