<?php 
class Workflow
{
	
	static private $wpfrSteps=Array(

	0 => Array(
		'stateDescription'=>"draft",
		'viewAction'=>"edit",
		'submitAction'=>"Submit this workplan for approval",
		),
	
	10=>Array(
		'stateDescription'=>"workplan waiting for administrative check",
		'viewAction'=>"show",
		'submitAction'=>"",
		),
	
	20=>Array(
		'stateDescription'=>"workplan waiting for schoolmaster's approval",
		'viewAction'=>"show",
		'submitAction'=>"",
		),
	
	30=>Array(
		'stateDescription'=>"intermediate / final report",
		'viewAction'=>"edit",
		'submitAction'=>"Submit this report",
		),
	
	40=>Array(
		'stateDescription'=>"intermediate report waiting for schoolmaster's evaluation",
		'viewAction'=>"show",
		'submitAction'=>"",
		),
	
	50=>Array(
		'stateDescription'=>"final report waiting for administrative check",
		'viewAction'=>"show",
		'submitAction'=>"",
		),

	60=>Array(
		'stateDescription'=>"final report waiting for schoolmaster's evaluation",
		'viewAction'=>"show",
		'submitAction'=>"",
		),

	70=>Array(
		'stateDescription'=>"final report approved and archived",
		'viewAction'=>"show",
		'submitAction'=>"",
		)

	);

	static public function getWpfrSteps()
	{
		return self::$wpfrSteps;
	}
};
