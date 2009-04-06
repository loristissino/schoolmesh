<?php 
class Workflow
{
	
	static private $wpfrSteps=Array(

	1 => Array(
		'stateDescription'=>"draft",
		'owner' => Array(
			'viewAction'=>"fill",
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this workplan for approval',
			'submitDoneAction'=>'Workplan submitted for approval.',
			'submitNextState'=>10,
			),
		'actions' => Array()
		),
	
	10=>Array(
		'stateDescription'=>"workplan waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>10,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'wp_adm_ok',
				'submitDisplayedAction'=>'Approve&nbsp;workplan',
				'submitDoneAction'=>'Workplan administratively checked.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>20,
				),
			'reject' => Array(
				'permission'=>'wp_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;workplan',
				'submitDoneAction'=>'Workplan administratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>1,
				),
			)
		),
	
	20=>Array(
		'stateDescription'=>"workplan waiting for schoolmaster's approval",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>20,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>"wp_sm_ok",
				'submitDisplayedAction'=>'Approve&nbsp;workplan',
				'submitDoneAction'=>'Workplan approved.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'false',
				'submitNextState'=>30,
				),
			'reject' => Array(
				'permission'=>"wp_sm_no",
				'submitDisplayedAction'=>'Reject&nbsp;workplan',
				'submitDoneAction'=>'Workplan rejected.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'true',
				'submitNextState'=>0,
				),
		),
	),
	
	30=>Array(
		'stateDescription'=>"intermediate / final report",
		'owner' => Array(
			'viewAction'=>"fill",
			'displayedAction'=>'Fill',
			'submitAction'=>"submit",
			'submitDisplayedAction'=>'Submit this report',
			'submitDoneAction'=>'Report submitted for approval',
			'submitNextState'=>50,
			),
		'actions' => Array(),
	),
	
	40=>Array(
		'stateDescription'=>"intermediate report waiting for schoolmaster's evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>40,
			),
		'actions' => Array()
		),
		
	50=>Array(
		'stateDescription'=>"final report waiting for administrative check",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>50,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'fr_adm_ok',
				'submitDisplayedAction'=>'Approve&nbsp;report',
				'submitDoneAction'=>'Report administratively checked.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>60,
				),
			'reject' => Array(
				'permission'=>'fr_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report adminisratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>30,
				),
		)
	),

	60=>Array(
		'stateDescription'=>"final report waiting for schoolmaster's evaluation",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>60,
			),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'fr_sm_ok',
				'submitDisplayedAction'=>'Approve&nbsp;report',
				'submitDoneAction'=>'Report approved.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>70,
				),
			'reject' => Array(
				'permission'=>'fr_sm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>30,
				),
		)
	),

	70=>Array(
		'stateDescription'=>"final report approved and archived",
		'owner' => Array(
			'viewAction'=>"view",
			'displayedAction'=>'View',
			'submitAction'=>"",
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>70,
			),
		'actions' => Array()
	)

	);
	

	static public function getWpfrSteps()
	{
		return self::$wpfrSteps;
	}

};
