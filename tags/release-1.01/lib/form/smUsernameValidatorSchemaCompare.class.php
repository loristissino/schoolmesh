<?php

class smUsernameValidatorSchemaCompare extends sfValidatorSchema
{

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * username:         The username to be checked
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the left field
   *
   * @param string $username   The username to be checked
   * @param array  $options     An array of options
   * @param array  $messages    An array of error messages
   *
   * @see sfValidatorBase
   */
  public function __construct($username, $options = array(), $messages = array())
  {
    $this->addOption('username', $username);

    $this->addOption('throw_global_error', false);

    parent::__construct(null, $options, $messages);
  }

  private function chechIfUsernameExists($username)
  {
    return true;
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

	$username=$values['username'];

    $valid = checkIfUsernameExists($username);
    
    if (!$valid)
    {
      $error = new sfValidatorError($this, 'invalid', array(
        'username'  => $username,
      ));
	  
      if ($this->getOption('throw_global_error'))
      {
        throw $error;
      }

      throw new sfValidatorErrorSchema($this, array($this->getOption('username') => $error));
    }

    return $values;
  }

  /**
   * @see sfValidatorBase
   */
  public function asString($indent = 0)
  {
		return 'username validator';
  }
}
