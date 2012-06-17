<?php

/*
 	 * smValidatorUsername validates a string as a username, checking against one or more databases.
*/

class smValidatorUsername extends sfValidatorSchema
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * field:              The field name
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the field
   *
   * @param string $field        The field name
   * @param array  $options     An array of options
   * @param array  $messages    An array of error messages
   *
   * @see sfValidatorBase
   */


  public function __construct($field, $options = array(), $messages = array())
  {
    $this->addOption('field', $field);
    $this->addOption('throw_global_error', false);
    parent::__construct(null, $options, $messages);
  }

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
// 	    $this->setOption('empty_value', '');
 	  }
 	
 	  /**
 	   * @see sfValidatorBase
 	   */
	protected function doClean($values)
 	  {
		
		if (is_null($values))
			{
			  $values = array();
			}

		if (!is_array($values))
			{
			  throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
			}

		$field  = isset($values[$this->getOption('field')]) ? $values[$this->getOption('field')] : null;

 	    $clean = (string) $field;
		
		$valid= true;
		
		if ($this->getIsAlreadyPresent($clean))
		{
			$error= new sfValidatorError($this, 'present', array('username'  => $clean));
			$valid=false;
		}
		elseif($this->getIsReserved($clean))
		{
			$error= new sfValidatorError($this, 'reserved', array('username'  => $clean));
			$valid=false;
		}
		
    if (!$valid)
    {
      if ($this->getOption('throw_global_error'))
      {
        throw $error;
      }

      throw new sfValidatorErrorSchema($this, array($this->getOption('field') => $error));
    }

    return $values;

	}
}
	
