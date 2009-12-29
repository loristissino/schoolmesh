<?php

/**
 * Account form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class PosixAccountForm extends BaseForm
{
  public function configure()
  {

	$this->setWidgets(array(
	  'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
	  'used_blocks'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
	  'used_files'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
	  'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
	  'soft_blocks_quota' => new sfWidgetFormInputText(array(), array('size'=>8)),
	  'hard_blocks_quota' => new sfWidgetFormInputText(array(), array('size'=>8)),
	  'soft_files_quota' => new sfWidgetFormInputText(array(), array('size'=>8)),
	  'hard_files_quota' => new sfWidgetFormInputText(array(), array('size'=>8)),
	));

	$this->widgetSchema->setNameFormat('accountinfo[%s]');
	
	$this->setValidators(array(
		'id' => new sfValidatorInteger(),
		'used_blocks' => new sfValidatorInteger(),
		'used_files' => new sfValidatorInteger(),
		'soft_blocks_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
		'hard_blocks_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
		'soft_files_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
		'hard_files_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),
	));
		
$this->validatorSchema->setPostValidator(
	new sfValidatorAnd(array(
		new sfValidatorSchemaCompare('soft_blocks_quota',
			sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'hard_blocks_quota',
			array(),
			array('invalid' => 'The soft blocks quota ("%left_field%") must be less than the hard blocks quota ("%right_field%").')
		),
		new sfValidatorSchemaCompare('soft_files_quota',
			sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'hard_files_quota',
			array(),
			array('invalid' => 'The soft files quota ("%left_field%") must be less than the hard files quota ("%right_field%").')
		),
		new sfValidatorSchemaCompare('soft_blocks_quota',
			sfValidatorSchemaCompare::GREATER_THAN_EQUAL, 'used_blocks',
			array(),
			array('invalid' => 'The soft blocks quota ("%left_field%") must be greater than the used blocks number ("%right_field%").')
		),
		new sfValidatorSchemaCompare('soft_files_quota',
			sfValidatorSchemaCompare::GREATER_THAN_EQUAL, 'used_files',
			array(),
			array('invalid' => 'The soft files quota ("%left_field%") must be greater than the used files number ("%right_field%").')
		),
		
	))
	);
	}
}
