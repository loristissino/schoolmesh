<?php

/*
 	 * sfValidatorUsername validates a string as a username, checking against one or more databases.
*/

class smValidatorUsername extends sfValidatorBase
{
 	  /**
 	   * Configures the current validator.
 	   *
 	   *
 	   * @param array $options   An array of options
 	   * @param array $messages  An array of error messages
 	   *
 	   * @see sfValidatorBase
 	   */


private function getIsAlreadyPresent($username)
	{
	return sfGuardUserProfilePeer::retrieveByUsername($username);
	}

private function getIsReserved($username)
	{
	return ReservedUsernamePeer::retrieveByUsername($username);
	}

protected function configure($options = array(), $messages = array())
 	  {

 	    $this->addMessage('present', 'Username "%username%" is already present.');
 	    $this->addMessage('reserved', 'Username "%username%" is reserved.');
 	    $this->setOption('empty_value', '');
 	  }
 	
 	  /**
 	   * @see sfValidatorBase
 	   */
 	  protected function doClean($value)
 	  {
 	    $clean = (string) $value;
 	

 	    if ($this->getIsAlreadyPresent($clean))
 	    {
 	      throw new sfValidatorError($this, 'present', array('username'=>$clean));
 	    }

 	    if ($this->getIsReserved($clean))
 	    {
 	      throw new sfValidatorError($this, 'reserved', array('username'=>$clean));
 	    }

	return $clean;


	}
}
	