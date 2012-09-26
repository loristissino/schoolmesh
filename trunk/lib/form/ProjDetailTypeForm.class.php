<?php

/**
 * ProjDetailType form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class ProjDetailTypeForm extends BaseProjDetailTypeForm
{
  public function configure()
  {
    $this['description']->getWidget()->setAttributes(array('size'=>80));
    $this['label']->getWidget()->setAttributes(array('size'=>80));
    $this['missing_value_message']->getWidget()->setAttributes(array('size'=>80));
    $this['filled_value_message']->getWidget()->setAttributes(array('size'=>80));
    $this['cols']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
    $this['rows']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
    $this['rank']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
    $this['state_min']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
    $this['state_max']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
  }
}
