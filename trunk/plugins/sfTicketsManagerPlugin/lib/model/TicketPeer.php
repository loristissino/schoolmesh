<?php

require 'plugins/sfTicketsManagerPlugin/lib/model/om/BaseTicketPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'ticket' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.sfTicketsManagerPlugin.lib.model
 */
class TicketPeer extends BaseTicketPeer {

    public static function retrieveOpen()
    {
        $c= new Criteria();
        // FIXME we should retrieve only open tickets...
        $c->addJoin(TicketPeer::TICKET_TYPE_ID, TicketTypePeer::ID);
        return self::doSelectJoinAll($c);
    }

} // TicketPeer
