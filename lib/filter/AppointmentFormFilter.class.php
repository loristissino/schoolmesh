<?php

/**
 * Appointment filter form.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class AppointmentFormFilter extends BaseAppointmentFormFilter
{
  public function configure()
  {

	$this->setWidgets(array('state'=> new sfWidgetFormChoice(array(
  'choices' => array('1'=>'DRAFT', 2=>'BLABLA'),
))
)
);

	
  }
/*
    public function setup()
  {
    parent::setup();
	
  }
*/

}
