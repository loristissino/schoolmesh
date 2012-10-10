<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);

$base_url= sfConfig::get('app_config_base_url');

$wget =  'wget -O - --no-check-certificate '  . $base_url . '/index.php/%s 2>/dev/null';

$tidy=$wget . ' | tidy -q -e';

$t = new lime_test(2, new lime_output_color());

$result=array();
$return_var=0;

/* NOTES
'profile' and other pages under authentication cannot be tested, because of the redirection...
*/

foreach(array(
	'content',
	'whosonline/html'
) as $page)
{
	$result=array();
	$command=sprintf($tidy, $page);
	exec($command, $result, $return_var);
	$response=implode('', $result);

	$t->is($return_var, 0, 'page is valid: ' . $page);
}






