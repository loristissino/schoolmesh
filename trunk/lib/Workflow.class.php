<?php 
class Workflow
{
	
	static private $wpfrSteps=Array(

	0 => Array(
		'stateDescription'=>"draft",
		'viewAction'=>"fill",
		'displayedAction'=>'Fill',
		'submitAction'=>"submit",
		'submitDisplayedAction'=>'Submit this workplan for approval',
		'submitDoneAction'=>'Workplan submitted for approval',
		'submitNextState'=>10,
		),
	
	10=>Array(
		'stateDescription'=>"workplan waiting for administrative check",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>10,
		),
	
	20=>Array(
		'stateDescription'=>"workplan waiting for schoolmaster's approval",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>20,
		),
	
	30=>Array(
		'stateDescription'=>"intermediate / final report",
		'viewAction'=>"fill",
		'displayedAction'=>'Fill',
		'submitAction'=>"submit",
		'submitDisplayedAction'=>'Submit this report',
		'submitDoneAction'=>'Report submitted for approval',
		'submitNextState'=>40,
		),
	
	40=>Array(
		'stateDescription'=>"intermediate report waiting for schoolmaster's evaluation",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>40,
		),
	
	50=>Array(
		'stateDescription'=>"final report waiting for administrative check",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>50,
		),

	60=>Array(
		'stateDescription'=>"final report waiting for schoolmaster's evaluation",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>60,
		),

	70=>Array(
		'stateDescription'=>"final report approved and archived",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>'',
		'submitDoneAction'=>'',
		'submitNextState'=>70,
		)

	);

	static public function getWpfrSteps()
	{
		return self::$wpfrSteps;
	}
};
