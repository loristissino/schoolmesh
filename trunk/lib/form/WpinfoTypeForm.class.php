<?php

/**
 * WpinfoType form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WpinfoTypeForm extends BaseWpinfoTypeForm
{
  public function configure()
  {
    
    $this['title']->getWidget()->setAttributes(array(
      'size'=>80,
      ));

    $this['description']->getWidget()->setAttributes(array(
      'size'=>100,
      ));

    foreach(array('rank', 'state_min', 'state_max', 'grade_min', 'grade_max') as $field)
    {
      $this[$field]->getWidget()->setAttributes(array(
        'size'=>5,
        'style'=>'text-align: right',
        ));
    }

    foreach(array('template', 'example') as $field)
    {
      $this[$field]->getWidget()->setAttributes(array(
        'cols'=>80,
        'rows'=>10,
        ));
    }

    $this['is_required']->getWidget()->setLabel('Required?');

    $this['is_confidential']->getWidget()->setLabel('Confidential?');

    
  }
}
