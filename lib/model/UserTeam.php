<?php

class UserTeam extends BaseUserTeam
{
    public function getFirstName()
    {
    return $this->getsfGuardUser()->getProfile()->getFirstName();    
    }
    public function getLastName()
    {
        return $this->getsfGuardUser()->getProfile()->getLastName();
    }
    
}