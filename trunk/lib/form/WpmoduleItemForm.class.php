<?php

/**
 * WpmoduleItem form.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WpmoduleItemForm extends BaseWpmoduleItemForm
{
  public function setup()
  {
		//parent::setup();
		/* questo qui sotto funziona 
		unset($this->widgetSchema['rank']);
		unset($this->widgetSchema['wpitem_group_id']);
		unset($this->widgetSchema['evaluation']);
		*/
		
		//unset($this['content'], $this['rank'], $this['wpitem_group_id'], $this['evaluation']);
	//	$this->validatorSchema['content']->setOption('min_length', 1);
		
		$this->setWidgets(Array(
			'content'=> new sfWidgetFormTextareaTinyMCE(
			array(
				'width'  => 700,
				'height' => 350,
//				'config' => 'theme:advanced',
			),
				array('class'=>'foo')
				)
			)
			);
/*        $this->setWidgets(array(
          'content'         => new sfWidgetFormInput(),
        ));
		
		$this->setValidators(array(
			'content' => new sfValidatorString(array('min_length' => 2, 'required' => true)),
    ));
*/
  }
}

