<?php

require 'plugins/sfTicketsManagerPlugin/lib/model/om/BaseTicket.php';


/**
 * Skeleton subclass for representing a row from the 'ticket' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.sfTicketsManagerPlugin.lib.model
 */
class Ticket extends BaseTicket {

    public function __toString()
    {
        return sprintf('%d - %s', $this->getId(), $this->getLimitedContent(20));
    }
    
    public function getLimitedContent($maxchars)
	{
        $content=$this->getContent();
        if(strlen($content)<=$maxchars)
        {
            return $content;
        }
		return substr($content, 0, $maxchars). '...';
	}

} // Ticket
