<?php

/**
 * EmailChangeConfirmationMessage class.
 *
 * @package    schoolmesh
 * @subpackage mail
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class EmailChangeConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user, sfContext $sfContext=null)
  {
    parent::__construct();
	
	  $replacements=array(
		  '%verification_code%'=>$user->getEmailVerificationCode(),
		  '%username%'=>$user->getUsername(),
		  );
	
  	$this
    ->parseTemplate('email_change_confirmation.yml', $user, $sfContext)
    ->addStandardTagline()
    ->makeReplacements($replacements)
	  ->setTo(array($user->getEmail() => $user->getFullName()))
    ;
  }
}
