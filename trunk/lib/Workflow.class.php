<?php 
class Workflow
{
	const 	AP_ASSIGNED = 0;
	const 	WP_DRAFT = 10;
	const 	WP_WADMC = 20;
	const 	WP_WSMC = 30;
	const 	IR_DRAFT = 40;
	const 	IR_WSMC = 50;
	const 	FR_WADMC = 60;
	const 	FR_WSMC = 70;
	const 	FR_ARCHIVED = 80;
	
	static private $wpfrSteps=Array(

	self::AP_ASSIGNED=>Array(
		'stateDescription'=>"Appointment just set",
		'owner' => Array(),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'office',
				'submitDisplayedAction'=>'Confirm appointment',
				'submitDoneAction'=>'Appointment confirmed.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'logMessageCode'=>'AP_CONFIRMED',
				'submitNextState'=>self::WP_DRAFT,
				)
			)
		),

	self::WP_DRAFT => Array(
		'stateDescription'=>"Workplan draft",
		'owner' => Array(
			'viewAction'=>"fill",
			'exportActionTip'=>'Export the workplan in one of the available formats',
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this workplan for approval',
			'submitDoneAction'=>'Workplan submitted for approval.',
			'submitNextState'=>self::WP_WADMC,
			),
		'actions' => Array()
		),
	
	self::WP_WADMC=>Array(
		'stateDescription'=>"Workplan waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the workplan in one of the available formats',
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::WP_WADMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'office',
				'submitDisplayedAction'=>'Approve workplan',
				'submitDoneAction'=>'Workplan administratively checked.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'logMessageCode'=>'WP_APPROVED',
				'submitNextState'=>self::WP_WSMC,
				),
			'reject' => Array(
				'permission'=>'office',
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan administratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'logMessageCode'=>'WP_REJECTED',
				'submitNextState'=>self::WP_DRAFT,
				),
			)
		),
	
	self::WP_WSMC=>Array(
		'stateDescription'=>"Workplan waiting for schoolmaster`s approval",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the workplan in one of the available formats',
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::WP_WSMC,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>"schoolmaster",
				'submitDisplayedAction'=>'Approve workplan',
				'submitDoneAction'=>'Workplan approved.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'false',
				'logMessageCode'=>'WP_APPROVED',
				'submitNextState'=>self::IR_DRAFT,
				),
			'reject' => Array(
				'permission'=>"schoolmaster",
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan rejected.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'true',
				'logMessageCode'=>'WP_REJECTED',
				'submitNextState'=>self::WP_DRAFT,
				),
		),
	),
	
	self::IR_DRAFT=>Array(
		'stateDescription'=>"Intermediate / final report",
		'owner' => Array(
			'viewAction'=>"fill",
			'exportActionTip'=>'Export the workplan in one of the available formats',
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this report',
			'submitDoneAction'=>'Report submitted for approval.',
			'submitNextState'=>self::FR_WADMC,
			),
		'actions' => Array(),
	),
	
	self::IR_WSMC=>Array(
		'stateDescription'=>"Intermediate report waiting for schoolmaster`s evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the report in one of the available formats',
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>self::IR_WSMC,
			),
		'actions' => Array()
		),
		
	self::FR_WADMC=>Array(
		'stateDescription'=>"Final report waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the report in one of the available formats',
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
		'stateDescription'=>"Final report waiting for schoolmaster`s evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the report in one of the available formats',
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
		'stateDescription'=>"Final report approved and archived",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the report in one of the available formats',
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

	static public function getWpfrStates()
	{
		$steps=self::$wpfrSteps;
		$states=Array();
		foreach($steps as $key=>$value)
		{
			$states[$key]=$value['stateDescription'];
		}
		return $states;
	}

	static public function getEmailVerificationStates()
	{
		return array('unverified', 'waiting', 'verified');
	}

	static public function getGoogleappsAccountStatusses()
	{
		return array(null=>'unverified', 0=>'not existent', 1=>'not activated', 8=>'not recently used', 9=>'recently used');
	}



};
