<?php

/**
 * WpitemType form.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WpitemTypeForm extends BaseWpitemTypeForm
{
  public function configure()
  {
    $this['title']->getWidget()->setAttributes(array(
      'size'=>80,
      ));

    $this['description']->getWidget()->setAttributes(array(
      'size'=>100,
      ));

    foreach(array('rank', 'state_min', 'state_max', 'grade_min', 'grade_max', 'evaluation_min', 'evaluation_max') as $field)
    {
      $this[$field]->getWidget()->setAttributes(array(
        'size'=>5,
        'style'=>'text-align: right',
        ));
    }

    $this['is_required']->getWidget()->setLabel('Required?');

    $this['evaluation_min_description']->getWidget()
    ->setAttributes(array(
      'size'=>100,
      ))
    ->setLabel('Description<br />(evaluation min)')
    ;
    $this['evaluation_max_description']->getWidget()
    ->setAttributes(array(
      'size'=>100,
      ))
    ->setLabel('Description<br />(evaluation max)')
    ;

    
  }
}
