<?php

/**
 * ProjCategory form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ProjCategoryForm extends BaseProjCategoryForm
{
  public function configure()
  {
    $this['title']->getWidget()->setAttributes(array('size'=>80));
    $this['rank']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
    $this['resources']->getWidget()->setAttributes(array('size'=>4, 'style'=>'text-align: right'));
  }
}
