<?php 
class Workflow
{
	
	static private $wpfrSteps=Array(

	0 => Array(
		'stateDescription'=>"draft",
		'viewAction'=>"fill",
		'displayedAction'=>'Fill',
		'submitAction'=>"submitplan",
		'submitDisplayedAction'=>'Submit this workplan for approval'
		),
	
	10=>Array(
		'stateDescription'=>"workplan waiting for administrative check",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		),
	
	20=>Array(
		'stateDescription'=>"workplan waiting for schoolmaster's approval",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		),
	
	30=>Array(
		'stateDescription'=>"intermediate / final report",
		'viewAction'=>"fill",
		'displayedAction'=>'Fill',
		'submitAction'=>"submitreport",
		'submitDisplayedAction'=>'Submit this report'
		),
	
	40=>Array(
		'stateDescription'=>"intermediate report waiting for schoolmaster's evaluation",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		),
	
	50=>Array(
		'stateDescription'=>"final report waiting for administrative check",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		),

	60=>Array(
		'stateDescription'=>"final report waiting for schoolmaster's evaluation",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		),

	70=>Array(
		'stateDescription'=>"final report approved and archived",
		'viewAction'=>"view",
		'displayedAction'=>'View',
		'submitAction'=>"",
		'submitDisplayedAction'=>''
		)

	);

	static public function getWpfrSteps()
	{
		return self::$wpfrSteps;
	}
};
