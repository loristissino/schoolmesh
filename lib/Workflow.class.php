<?php 
class Workflow
{
	const 	WP_DRAFT = 0;
	const 	WP_WADMC = 10;
	const 	WP_WSMC = 20;
	const 	IR_DRAFT = 30;
	const 	IR_WSMC = 40;
	const 	FR_WADMC = 50;
	const 	FR_WSMC = 60;
	const 	FR_ARCHIVED = 70;
	
	static private $wpfrSteps=Array(

	self::WP_DRAFT => Array(
		'stateDescription'=>"draft",
		'owner' => Array(
			'viewAction'=>"fill",
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this workplan for approval',
			'submitDoneAction'=>'Workplan submitted for approval.',
			'submitNextState'=>self::WP_WADMC,
			),
		'actions' => Array()
		),
	
	self::WP_WADMC=>Array(
		'stateDescription'=>"workplan waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::WP_WADMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'schoolmaster',
				'submitDisplayedAction'=>'Approve&nbsp;workplan',
				'submitDoneAction'=>'Workplan administratively checked.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::WP_WSMC,
				),
			'reject' => Array(
				'permission'=>'wp_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;workplan',
				'submitDoneAction'=>'Workplan administratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::WP_DRAFT,
				),
			)
		),
	
	self::WP_WSMC=>Array(
		'stateDescription'=>"workplan waiting for schoolmaster's approval",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::WP_WSMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>"wp_sm_ok",
				'submitDisplayedAction'=>'Approve&nbsp;workplan',
				'submitDoneAction'=>'Workplan approved.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'false',
				'submitNextState'=>self::IR_DRAFT,
				),
			'reject' => Array(
				'permission'=>"wp_sm_no",
				'submitDisplayedAction'=>'Reject&nbsp;workplan',
				'submitDoneAction'=>'Workplan rejected.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'true',
				'submitNextState'=>self::WP_DRAFT,
				),
		),
	),
	
	self::IR_DRAFT=>Array(
		'stateDescription'=>"intermediate / final report",
		'owner' => Array(
			'viewAction'=>"fill",
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this report',
			'submitDoneAction'=>'Report submitted for approval',
			'submitNextState'=>self::FR_WADMC,
			),
		'actions' => Array(),
	),
	
	self::IR_WSMC=>Array(
		'stateDescription'=>"intermediate report waiting for schoolmaster's evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::IR_WSMC,
			),
		'actions' => Array()
		),
		
	self::FR_WADMC=>Array(
		'stateDescription'=>"final report waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::FR_WADMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'fr_adm_ok',
				'submitDisplayedAction'=>'Approve&nbsp;report',
				'submitDoneAction'=>'Report administratively checked.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::FR_WSMC,
				),
			'reject' => Array(
				'permission'=>'fr_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report adminisratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::IR_DRAFT,
				),
		)
	),

	self::FR_WSMC=>Array(
		'stateDescription'=>"final report waiting for schoolmaster's evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::FR_WSMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'fr_sm_ok',
				'submitDisplayedAction'=>'Approve&nbsp;report',
				'submitDoneAction'=>'Report approved.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::FR_ARCHIVED,
				),
			'reject' => Array(
				'permission'=>'fr_sm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::IR_DRAFT,
				),
		)
	),

	self::FR_ARCHIVED=>Array(
		'stateDescription'=>"final report approved and archived",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::FR_ARCHIVED,
			),
		'actions' => Array()
	)

	);
	

	static public function getWpfrSteps()
	{
		return self::$wpfrSteps;
	}

};
