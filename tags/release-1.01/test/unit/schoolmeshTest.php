<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);

$base_url= sfConfig::get('app_config_base_url');

$commands_view= sfConfig::get('app_system_commands_view');
$commands_apply= sfConfig::get('app_system_commands_apply');

$wget =  'wget -O - --no-check-certificate '  . $base_url . '/frontend_dev.php/content/webserver/cmd/%s 2>/dev/null';

$tests=7;
if($commands_view) $tests+=5;
if($commands_apply) $tests+=1;

$t = new lime_test($tests, new lime_output_color());

$t->pass('SchoolMesh seems to be installed correctly.');


$result=array();
$return_var=0;

$command=sprintf($wget,  'whoami');
exec($command, $result, $return_var);
$response=implode('', $result);

$t->diag('webserver configuration: ' . $response);

$command=sprintf($wget,  'sudolist');
exec($command, $result, $return_var);
$response=implode(',', $result);

$t->diag('webserver is configured to view data: ' . ($commands_view?'yes': 'no'));

if ($commands_view)
{
	foreach(array(
		'/usr/bin/stat',
		'/usr/bin/lsattr',
		'/usr/bin/getfacl',
		'/usr/bin/quota',
		'/usr/bin/chage --list'
	) as $sudocmd)

	{
		$t->like($response, '|(root).*NOPASSWD:.*' . $sudocmd . ',|', 'webserver can run ' . $sudocmd);
	}
}

$t->diag('webserver is configured to apply changes: ' . ($commands_apply?'yes': 'no'));

if ($commands_apply)
{

	foreach(array(
		'/usr/local/bin/schoolmesh*',
	) as $sudocmd)

	{
		$t->like($response, '|(root).*NOPASSWD:.*' . $sudocmd . ',|', 'webserver can run ' . $sudocmd);
	}
}


$t->diag('webserver is not supposed to do some things');

foreach(array(
	'/sbin/poweroff',
	'/usr/bin/killall',
) as $sudocmd)
{
	$t->unlike($response, '|(root).*NOPASSWD:.*' . $sudocmd . ',|', 'webserver cannot run ' . $sudocmd);
}

$t->diag('PHP configuration (cli)');
$t->is(ini_get('short_open_tag'), false, 'short_open_tag is set to off');
$t->cmp_ok(Generic::return_bytes(ini_get('memory_limit')), '>=', Generic::return_bytes('128M'), 'memory limit is ok');

$t->diag('PHP configuration (apache)');

$result='';
$command=sprintf($wget,  'short_open_tag');
exec($command, $result, $return_var);
$response=implode('', $result);

$t->is($response, false, 'short_open_tag is set to off');

$result='';
$command=sprintf($wget,  'memory_limit');
exec($command, $result, $return_var);
$response=implode('', $result);

$t->cmp_ok(Generic::return_bytes($response), '>=', Generic::return_bytes('64M'), 'memory limit is ok');


