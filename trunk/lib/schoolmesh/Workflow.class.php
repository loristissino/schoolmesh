<?php 
class Workflow
{
	const 	AP_ASSIGNED = 10;
	const 	WP_DRAFT = 20;
	const 	WP_WADMC = 30;
	const 	WP_WSMC = 40;
  const   WP_APPROVED = 41;
  /* 
   * this code 41 is just needed to generate attachments from the task,
   * since we need to consider the appointment in 'planning state'
   * to choose the correct template
   *
  */
	const 	IR_DRAFT = 50;
	const 	IR_WSMC = 60;
	const 	FR_WADMC = 70;
	const 	FR_WSMC = 80;
	const 	FR_ARCHIVED = 90;
  const   AP_NOTDONE = 100;
  
  static private $wpfrSteps=Array(

	self::AP_ASSIGNED=>Array(
		'stateDescription'=>"Appointment not confirmed",
		'owner' => Array(),
		'actions' => Array(
			'approve' => Array(
				'permission'=>'wp_adm_ok',
				'submitDisplayedAction'=>'Confirm appointment',
				'submitDoneAction'=>'Appointment confirmed.',
				'submitExtraActions'=>array(),
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
				'permission'=>'wp_adm_ok',
				'submitDisplayedAction'=>'Approve workplan',
				'submitDoneAction'=>'Workplan administratively checked.',
				'submitExtraActions'=>array(),
				'logMessageCode'=>'WP_ADCHECKED',
				'submitNextState'=>self::WP_WSMC,
        'makeAttachments'=>false,
        'sendEmail'=>false,
				),
			'reject' => Array(
				'permission'=>'wp_adm_no',
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan administratively rejected.',
				'submitExtraActions'=>array(
          'markSubItemsAsEditable'=>array('newstate'=>'true')
          ),
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
				'permission'=>"wp_sm_ok",
				'submitDisplayedAction'=>'Approve workplan',
				'submitDoneAction'=>'Workplan approved.',
				'submitExtraActions'=>array(
          'markSubItemsAsEditable'=>array('newstate'=>'false')
          ),
				'logMessageCode'=>'WP_APPROVED',
				'submitNextState'=>self::WP_APPROVED,
        'makeAttachments'=>false,
        'sendEmail'=>true,
				),
			'reject' => Array(
				'permission'=>"wp_sm_no",
				'submitDisplayedAction'=>'Reject workplan',
				'submitDoneAction'=>'Workplan rejected.',
				'submitExtraActions'=>array(
          'markSubItemsAsEditable'=>array('newstate'=>'true')
          ),
				'logMessageCode'=>'WP_REJECTED',
				'submitNextState'=>self::WP_DRAFT,
        'makeAttachments'=>false,
        'sendEmail'=>true,
				),
		),
	),
  
	self::WP_APPROVED=>Array(
		'stateDescription'=>"Workplan approved",
		'owner' => Array(
			'viewAction'=>"view",
			'exportActionTip'=>'Export the workplan in one of the available formats',
			'displayedAction'=>'View',
			'submitAction'=>'',
			'submitDisplayedAction'=>'',
			'submitDoneAction'=>'',
			'submitNextState'=>null,
			),
		'actions' => Array(),
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
				'submitExtraActions'=>array(),
				'submitNextState'=>self::FR_WSMC,
				'logMessageCode'=>'FR_ADAPPROVED',
        'makeAttachments'=>false,
        'sendEmail'=>false,
				),
			'reject' => Array(
				'permission'=>'fr_adm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report adminisratively rejected.',
				'submitExtraActions'=>array(),
				'submitNextState'=>self::IR_DRAFT,
				'logMessageCode'=>'FR_ADREJECTED',
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
				'submitExtraActions'=>array(),
				'submitNextState'=>self::FR_ARCHIVED,
				'logMessageCode'=>'FR_APPROVED',
        'makeAttachments'=>false,
        'sendEmail'=>true,
				),
			'reject' => Array(
				'permission'=>'fr_sm_no',
				'submitDisplayedAction'=>'Reject&nbsp;report',
				'submitDoneAction'=>'Report rejected.',
				'submitExtraActions'=>array(),
				'submitNextState'=>self::IR_DRAFT,
				'logMessageCode'=>'FR_REJECTED',
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
			'logMessageCode'=>'FR_ARCHIVED',
			),
		'actions' => Array()
	),

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
		return array('undefined', 'waitingvalidation', 'verified', 'faulty');
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
    PROJ_CONFIRMED = 50,
    PROJ_FINISHED = 60;
	
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

	self::PROJ_CONFIRMED=>Array(
		'stateDescription'=>"Project confirmed",
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
