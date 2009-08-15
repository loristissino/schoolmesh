<?php

class AccountType extends BaseAccountType
{
	public function __toString()
	{
		return $this->getName();
	}
	
}
