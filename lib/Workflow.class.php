<?php 
class Workflow
{
	const 	AP_ASSIGNED = 10;
	const 	WP_DRAFT = 20;
	const 	WP_WADMC = 30;
	const 	WP_WSMC = 40;
	const 	IR_DRAFT = 50;
	const 	IR_WSMC = 60;
	const 	FR_WADMC = 70;
	const 	FR_WSMC = 80;
	const 	FR_ARCHIVED = 90;
  
  static private $wpfrSteps=Array(

	self::AP_ASSIGNED=>Array(
		'stateDescription'=>"Appointment not confirmed",
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
        'makeAttachments'=>false,
        'sendEmail'=>false,
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
				'logMessageCode'=>'WP_ADCHECKED',
				'submitNextState'=>self::WP_WSMC,
        'makeAttachments'=>false,
        'sendEmail'=>false,
				),
			'reject' => Array(
				'permission'=>'office',
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan administratively rejected.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'true',
				'logMessageCode'=>'WP_ADREJECTED',
				'submitNextState'=>self::WP_DRAFT,
        'makeAttachments'=>false,
        'sendEmail'=>true,
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
        'makeAttachments'=>true,
        'sendEmail'=>true,
				),
			'reject' => Array(
				'permission'=>"schoolmaster",
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan rejected.',
				'submitExtraAction'=>'markSubItems',
				'submitExtraParameters'=>'true',
				'logMessageCode'=>'WP_REJECTED',
				'submitNextState'=>self::WP_DRAFT,
        'makeAttachments'=>false,
        'sendEmail'=>true,
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
        'makeAttachments'=>false,
        'sendEmail'=>false,
				),
			'reject' => Array(
				'permission'=>'fr_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report adminisratively rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::IR_DRAFT,
        'makeAttachments'=>false,
        'sendEmail'=>false,
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
        'makeAttachments'=>true,
        'sendEmail'=>true,
				),
			'reject' => Array(
				'permission'=>'fr_sm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report rejected.',
				'submitExtraAction'=>'',
				'submitExtraParameters'=>'',
				'submitNextState'=>self::IR_DRAFT,
        'makeAttachments'=>false,
        'sendEmail'=>true,
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

	static public function getWpfrStates($asObjects=false)
	{
		
		//FIXME It would be better to return always objects that implement array access
		
		$steps=self::$wpfrSteps;
		$states=Array();
		
		foreach($steps as $key=>$value)
		{
			if($asObjects)
			{
				$states[]=new Item($key, $value['stateDescription']);
			}
			else
			{
				$states[$key]=$value['stateDescription'];
			}
			
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

  const
    PROJ_DRAFT = 10,
    PROJ_SUBMITTED = 20,
    PROJ_APPROVED = 30,
    PROJ_FINANCED = 40,
    PROJ_FINISHED = 50;
	
	static private $projSteps=Array(

	self::PROJ_DRAFT=>Array(
		'stateDescription'=>"Project draft",
		),
    
	self::PROJ_SUBMITTED=>Array(
		'stateDescription'=>"Project submitted",
		),

	self::PROJ_APPROVED=>Array(
		'stateDescription'=>"Project approved",
		),
    
	self::PROJ_FINANCED=>Array(
		'stateDescription'=>"Project financed",
		),

  self::PROJ_FINISHED=>Array(
		'stateDescription'=>"Project finished",
		),
  );
  
  static public function getProjSteps()
	{
		return self::$projSteps;
	}


};
