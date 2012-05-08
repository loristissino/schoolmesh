<?php

/**
 * Team form.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class TeamForm extends BaseTeamForm
{
  public function configure()
  {
      $this->setValidators(array(
      'description'   => new sfValidatorString(array('required'=>true, 'trim'=>true)),
      'posix_name'    => new sfValidatorString(array('required'=>true, 'trim'=>true)),
      'quality_code'  => new sfValidatorString(array('required'=>false, 'trim'=>true)),
      'id'            => new sfValidatorInteger(),
      'needs_folder'  => new sfValidatorBoolean(array('required'=>false)),
      'needs_mailing_list'  => new sfValidatorBoolean(array('required'=>false)),
      'is_public'     => new sfValidatorBoolean(array('required'=>false)),

      
      
    ));

  }
}
