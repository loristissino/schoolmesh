<?php

class Service extends BaseService
{
    public function __toString()
    {
    return $this->getName() . ($this->getIsUdp()? ' (udp)' : '');    
    }
    
}
