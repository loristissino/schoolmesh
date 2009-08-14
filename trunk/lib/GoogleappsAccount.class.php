<?php
/**
 * GoogleappsAccount class
 * @package schoolmesh
 * @subpackage classes
 */
class GoogleappsAccount extends ExternalAccount {

		public function applyDefaultValues()
	{
		
	}
	
  /**
   * Returns the status of the External account
   *
   * @return Boolean true if the account exists, false otherwise
   */
  public function getExists()
	{
		return false;
	}
	
  /**
   * Creates the External account
   *
   * @return Boolean true if the account was created, false otherwise
   */
  public function createAccount()
	{
		return false;
	}
	
  /**
   * Generates a random value as a password, applies the password for the external account
   * and stores it in the internal database
   *
   * @return Boolean true if the password was created and applied, false otherwise
   */
  public function setTemporaryPassword()
	{
		return false;
	}

  /**
   * Returns the temporary password
   *
   * @return Boolean|String the temporary password, is it is set; otherwise false
   */
  public function getTemporaryPassword()
	{
		return false;
	}

  /**
   * Deletes the temporary password stored in the internal database
   *
   * @return Boolean true
   */
  public function removeTemporaryPassword()
	{
		return false;
	}

  /**
   * Informs about whether the account can be definitely removed
   *
   * @return Boolean true if the account can be definitely removed, false otherwise
   */
  public function getIsDeletable()
	{
		return false;
	}

  /**
   * Informs about whether the account is locked (suspended)
   *
   * @return Boolean true if the account is locked, false otherwise
   */
  public function getIsLocked()
	{
		return false;
	}

  /**
   * Locks (suspends) the account
   *
   * @return Boolean true if the account was successfully locked, false otherwise
   */
  public function setIsLocked()
	{
		return false;
	}

  /**
   * Locks (suspends) the account
   *
   * @return Boolean|Timestamp false if the account does not have a last login, the timestamp otherwise
   */
  public function getLastKnownLoginAt()
	{
		return false;
	}

}