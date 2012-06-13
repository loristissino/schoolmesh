<?php

require 'plugins/sfTicketsManagerPlugin/lib/model/om/BaseTicketType.php';


/**
 * Skeleton subclass for representing a row from the 'ticket_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.sfTicketsManagerPlugin.lib.model
 */
class TicketType extends BaseTicketType {

    public function __toString()
    {
        return $this->getDescription();
    }

} // TicketType
