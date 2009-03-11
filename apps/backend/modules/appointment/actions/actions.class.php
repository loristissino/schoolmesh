<?php

require_once dirname(__FILE__).'/../lib/appointmentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/appointmentGeneratorHelper.class.php';

/**
 * appointment actions.
 *
 * @package    mattiussi
 * @subpackage appointment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class appointmentActions extends autoAppointmentActions
{
    
      public function executeUpdate(sfWebRequest $request)
  {
    $this->appointment = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->appointment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

    
}
