<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(52, new lime_output_color());

$t->diag('::datetime()');

$date=time();

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for now');

$offset=date('Z');

$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday'], $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for today\'s Midnight');

$t->like(Generic::datetime($date-1), '/Yesterday.*/', '::datetime() returns Yesterday for today\'s Midnight minus 1 second');

$infodate=getdate(time());
$date=mktime(12, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s noon');

$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s midnight');

$t->like(Generic::datetime($date-1), '/[0-9].*/', '::datetime() returns a date for yesterday\'s midnight minus 1 second');


$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-2, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/[0-9].*/', '::datetime() returns a date for previuos timestamps');

$t->diag('::date_difference_from_now()');


$string=date('Ymd');

$t->is(Generic::date_difference_from_now($string), 0, '::date_difference_from_now() returns 0 for now');

$string=date('Ymd', mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset);

$t->is(Generic::date_difference_from_now($string), 1, '::date_difference_from_now() returns 1 for yesterday, midnight');

$string=date('Ymd', mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-2, $infodate['year'])+$offset);

$t->is(Generic::date_difference_from_now($string), 2, '::date_difference_from_now() returns 2 for two days ago');


$t->diag('::transliterate()');

foreach(array(
	'€'=>'EUR',
	'bebé'=>'bebe',
	'là'=>'la',
	'foo.bèr'=>'foo.ber',
	'wladisław'=>'wladislaw',
	'Łęczewski'=>'Leczewski',
	'Myklegård' => 'Myklegaard',
	'München'=>'Muenchen',
	'Bosøw' => 'Bosow',
	'Đakovo' => 'Djakovo',
	'niño'=>'nino',
	'+-*/'=>'+-*/',
	) as $key=>$value)
{
	$t->is(Generic::transliterate($key), $value, sprintf('«%s» is transliterated into «%s»', $key, $value));
}

$t->diag('::slugify()');

foreach(array(
	' '=>'',
	'foo '=>'foo',
	' foo'=>'foo',
	'foo bar'=>'foobar',
	'foo.bar'=>'foo.bar',
	'foo-bar'=>'foo-bar',
	'FOO'=>'foo',
	) as $key=>$value)
{
	$t->is(Generic::slugify($key), $value, sprintf('«%s» is slugified into «%s»', $key, $value));
}


$t->diag('::transform_bad_diacritics("foo")');

try
{
	Generic::transform_bad_diacritics('foo', '');
	$t->fail('no code should be executed after throwing an exception (invalid culture)');
}
catch (Exception $e)
{
  $t->pass('exception catched successfully: '. $e);
}

$t->diag('::transform_bad_diacritics("it")');

foreach(array(
	'foo'=>'foo',
	'FOO'=>'FOO',
	"Fooa'"=>'Fooà',
	"Fooe'"=>'Fooé',
	"Fooi'"=>'Fooì',
	"Fooo'"=>'Fooò',
	"Foou'"=>'Fooù',
	"F'OOA"=>"F'OOA",
	) as $key=>$value)
{
	$t->is(Generic::transform_bad_diacritics('it', $key), $value, sprintf('bad diacritics were stripped away («%s»  into «%s»)', $key, $value));
}


$t->diag('::clever_ucwords("it")');

try
{
	Generic::clever_ucwords('foo', 'dd');
	$t->fail('no code should be executed after throwing an exception (invalid culture)');
}
catch (Exception $e)
{
  $t->pass('exception catched successfully: '. $e);
}

foreach(array(
	'FOO'=>'Foo',
	'foo bar'=>'Foo Bar',
	'FOO BAR'=>'Foo Bar',
	'fOO bAR'=>'Foo Bar',
	'23foo bar'=>'23foo Bar',
	
	"FOOA'"=>'Fooà',
	"FOOE'"=>'Fooé',
	"Foo’"=>'Foò',
	"Foo`"=>'Foò',
	'FOO BAR'=>'Foo Bar',
	"FOOI'"=>'Fooì',
	"FOOO'"=>'Fooò',
	"FOOU'"=>'Fooù',
	"F'OOA"=>"F'ooa",
	"F'OOA"=>"F'Ooa",
	) as $key=>$value)
{
	$t->is(Generic::clever_ucwords('it', $key), $value, sprintf('«%s» correctly transformed into «%s»', $key, $value));
}

/*
Generic::string2number('paolo');
echo "\n";
Generic::string2number('paolo');
echo "\n";
Generic::string2number('Paolo');
echo "\n";
Generic::string2number('Paola');
echo "\n";
Generic::string2number('paola');
echo "\n";
Generic::string2number('paoloo');
echo "\n";
Generic::string2number('polo');
echo "\n";
*/

$a=array(1, 2, 3);
$b=array(1, '2', 3);


echo "Sono uguali? " . ($a==$b) ? 'yeah': 'no' . "\n";

print_r($a);
print_r($b);

print_r(array_diff($a, $b));

echo "\n";
