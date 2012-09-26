<?php

require 'lib/model/om/BaseAppointmentType.php';


/**

 * @package    lib.model
 */
class AppointmentType extends BaseAppointmentType {

	/**
	 * Initializes internal state of AppointmentType object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
  
  
  public function __toString()
  {
    return $this->getDescription();
  }
  

} // AppointmentType
