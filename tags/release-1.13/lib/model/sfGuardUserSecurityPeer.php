<?php

require 'lib/model/om/BasesfGuardUserSecurityPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'sf_guard_user_security' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class sfGuardUserSecurityPeer extends BasesfGuardUserSecurityPeer {

	public static function retrieveByUsername($username)
	{
    $c=new Criteria();
    $c->addJoin(sfGuardUserSecurityPeer::USER_ID, sfGuardUserPeer::ID);
    $c->add(sfGuardUserPeer::USERNAME, $username);
    $t = sfGuardUserSecurityPeer::doSelectOne($c);
    return $t;
	}

} // sfGuardUserSecurityPeer
