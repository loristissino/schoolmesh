<?php

/**
 * WptoolItemType form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WptoolItemTypeForm extends BaseWptoolItemTypeForm
{
  public function configure()
  {
    $this['description']->getWidget()->setAttributes(array(
      'size'=>100,
      ));

    foreach(array('rank', 'state_min', 'state_max', 'grade_min', 'grade_max', 'min_selected', 'max_selected') as $field)
    {
      $this[$field]->getWidget()->setAttributes(array(
        'size'=>5,
        'style'=>'text-align: right',
        ));
    }

  }
}
