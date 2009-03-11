<?php

class Team extends BaseTeam
{
    
    public function __toString()
    {
            return $this->getDescription();
    }
}
