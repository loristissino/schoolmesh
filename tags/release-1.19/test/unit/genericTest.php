<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(110, new lime_output_color());

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


$t->diag('::clever_date("it")');

$date=Generic::clever_date('it', '10/03/1997');

$t->is(date_format($date, 'd/m/Y'), '10/03/1997', 'date correcty parsed');

$t->diag('::strip_tags_and_attributes()');

$allowable_tags='<br/><br><em><sup><sub>';
foreach (array(
'foo' => 'foo',
'foo<p>bar' => 'foobar',
'foo<p>bar</p>' => 'foobar',
'foo<p>bar</p>foo' => 'foobarfoo',
'foo<p >bar</p>foo' => 'foobarfoo',
'foo<p>bar</p >foo' => 'foobarfoo',
'foo<p foo >bar</p >foo' => 'foobarfoo',
'foo<em>bar</em>foo' => 'foo<em>bar</em>foo',
'foo<em baz>bar</em>foo' => 'foo<em>bar</em>foo',
'foo<em baz="moo">bar</em>foo' => 'foo<em>bar</em>foo',
'foo<em baz=\'moo\'>bar</em>foo' => 'foo<em>bar</em>foo',
'foo<sup>bar</sup> baz <sub>moo</sub>' => 'foo<sup>bar</sup> baz <sub>moo</sub>',
'foo<sup abc=\'def\'>bar</sup> baz <sub>moo</sub>' => 'foo<sup>bar</sup> baz <sub>moo</sub>',
'foo<br/>bar' => 'foo<br />bar',
'foo<br />bar' => 'foo<br />bar',
'foo<!-- baz -->bar' => 'foobar',
'   foo' => 'foo',
'foo   ' => 'foo',
'   foo   ' => 'foo',
"\nfoo" => 'foo',
"\n\nfoo" => 'foo',
"\rfoo" => 'foo',
"\r\nfoo" => 'foo',
"\n\rfoo" => 'foo',


) as $key=>$value)
{
	$t->is(Generic::strip_tags_and_attributes($key, $allowable_tags), $value, sprintf('«%s» --> «%s»', $key, $value));
}


$t->diag('::date_from_array()');

$t->is(Generic::date_from_array(''), null, 'returns null for empty string');
$t->is(Generic::date_from_array(array('foo', 'bar', 'baz')), null, 'returns null for an invalid array');
$t->is(Generic::date_from_array(array('month'=>'foo', 'day'=>'bar', 'year'=>'baz')), null, 'returns null for an invalid array');
$t->is(Generic::date_from_array(array('month'=>13, 'day'=>2, 'year'=>2000)), null, 'returns null for an invalid date');
$t->is(Generic::date_from_array(array('month'=>12, 'day'=>31, 'year'=>2000)), 978217200, 'returns the correct timestamp for a valid date');


$t->diag('::netMatch()');
foreach(array(
  '192.168.1.1'=>true,
  '192.168.2.3'=>true,
  '192.170.1.1'=>false,
  ) as $value=>$upshot)
{
  $t->is(Generic::netMatch('192.168.0.0/16', $value), $upshot, '::netMatch() works for ' . $value);
}

foreach(array(
  '192.168.1.3'=>true,
  '192.168.2.1'=>false,
  ) as $value=>$upshot)
{
  $t->is(Generic::netMatch('192.168.1.0/24', $value), $upshot, '::netMatch() works for ' . $value);
}


foreach(array(
  'foo'=>false,
  '12'=>12,
  '32'=>32,
  '10:30'=>10.5,
  '10:45'=>10.75,
  '10:45:00'=>false,
  '10:65'=>false,
  '10:60'=>false,
  '10:6'=>false,
  '10:06'=>10.1,
  '10:-10'=>false,
  '1:15'=>1.25,
  '0:15'=>0.25,
  '0:20'=>0.33333333333333333,
  '0'=>0,
  '-2'=>false,
  '-2:30'=>false,
  ) as $value=>$upshot)
{
  $t->is(Generic::getHoursAsNumber($value, ':'), $upshot, '::getHoursAsNumber() works for ' . $value);
}

foreach(array(
  Generic::timefromdate('20120131') => Generic::timefromdate('20130131'),
  Generic::timefromdate('20120930') => Generic::timefromdate('20130930'),
  ) as $value=>$upshot)
{
  $t->is(Generic::cloneDate($value, Generic::timefromdate('20120831'), Generic::timefromdate('20130831')), $upshot, '::cloneDate() works for ' . date('d/m/Y', $value));
}

foreach(array(
  Generic::timefromdate('20110131') => Generic::timefromdate('20130131'),
  Generic::timefromdate('20110930') => Generic::timefromdate('20130930'),
  ) as $value=>$upshot)
{
  $t->is(Generic::cloneDate($value, Generic::timefromdate('20110831'), Generic::timefromdate('20130831')), $upshot, '::cloneDate() works for ' . date('d/m/Y', $value));
}

foreach(array(
  Generic::timefromdate('20130131') => Generic::timefromdate('20130131'),
  Generic::timefromdate('20130930') => Generic::timefromdate('20130930'),
  ) as $value=>$upshot)
{
  $t->is(Generic::cloneDate($value, Generic::timefromdate('20130831'), Generic::timefromdate('20130831')), $upshot, '::cloneDate() works for ' . date('d/m/Y', $value));
}
