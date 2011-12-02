<?php

/**
 * Service class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class Service extends BaseService
{
    public function __toString()
    {
    return $this->getName() . ($this->getIsUdp()? ' (udp)' : '');    
    }
    
}
